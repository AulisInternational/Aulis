<?php
/*
|| Aulis
|| Organisation:	Aulis International
|| Website:			http://germanics.org/aulis
|| Developed by: 	Robert Monden
					Thomas de Roo
|| License: 		MIT
|| Version: 		0.01
|| * File information * 
||		-> database.functions.php
| 		-> // This file contains the functions that handle database queries
|| 		-> Last change: July, 2015
*/

// We can't access this file, if not from index.php, so let's check
if(!defined('aulis'))
	header("Location: index.php");


// This function setups the database connection.
function au_setup_database(){
		
	// This thing is important, it contains the database settings
	global $aulis;

	// In case something goes wrong
	$db = null;

	// Let's see if we maybe need MySQL or PSQL
	if($aulis['db_driver'] == 'mysql' || $aulis['db_driver'] == 'psql')
		try{
			@$db = new PDO($aulis['db_driver'] . ':host='.$aulis['db_host'].';dbname='.$aulis['db_database'], $aulis['db_user'], $aulis['db_password']);
		}
		catch(PDOException $e){
			au_fatal_error(1, $e->getMessage());
		}

	// Or some database saved in files... who knows?
	elseif($aulis['db_driver'] == 'sqlite')
		try{
			@$db = new PDO('sqlite:'.$aulis['db_database']);
		}
		catch(PDOException $e){
			au_fatal_error(1, $e->getMessage());
		}
		
	// Apparently someone didn't get the message.
	else
		au_fatal_error(5, "Used " . $aulis['db_driver'] . " as database type.");

	// Transfer the connection to $aulis
	return $aulis['db'] = $db;

}

function au_query($original_sql, $force_no_cache = false, $force_no_count = false){

	global $aulis, $setting;

	// We like counting
	if(!$force_no_count)
		$aulis['db_query_count']++;

	// Make sure we have the right database prefix.
	$search = array("FROM ", "INTO ", "UPDATE ", "JOIN ");
	$replace = array("FROM ".$aulis['db_prefix'], "INTO ".$aulis["db_prefix"], "UPDATE ".$aulis["db_prefix"],  "JOIN ".$aulis["db_prefix"]);
	$sql = str_replace($search, $replace, $original_sql);

	// Are we in debug mode? ONLY ALPHA :: NOTE: THIS WILL SEND THE HEADERS AWAY
	if(DEBUG_SHOW_QUERIES)
		echo "<div class='notice bg1 cwhite'>".$sql."</div>";

	// If query caching is disabled, we just need to execute the query
	if($force_no_cache or @$setting['enable_query_caching'] == 0)
		return $aulis["db"]->query($sql);

	// If this is not a select query, it will change something, therefore the cache needs to be cleaned
	if(!au_string_starts_with($sql, "SELECT"))
		au_force_clean_cache('queries');

	// Only select queries can be cached
	if(!au_string_starts_with($sql, "SELECT"))
		return $aulis["db"]->query($sql);

	// We need the queries hash
	$hash = md5($sql);
	$cache_file = au_get_path_from_root('cache/queries/'.$hash.'.cache');
	$cache_folder = au_get_path_from_root('cache/queries');
	$cache_time = $setting['query_caching_time'];

	// If we are not writable, we have to run the query without cache
	if(!is_writable($cache_folder))
		return $aulis["db"]->query($sql);

	// We need to see if there are any queries like these done within the query_cache_time
	if(file_exists($cache_file)){
		
		// Our file exists... let's get its creation time
		$cache_file_time = filemtime($cache_file);

		// Is the file still valid?
		 if (time() - $cache_file_time < $cache_time and $aulis['db_query_count']--)
		 	return unserialize(file_get_contents($cache_file));

		// If not we need to delete it and be a little recursive...
		else if(unlink($cache_file))
			return au_query($original_sql, false, true);

	}

	// The query isn't cached... or it is unvalid and therefore deleted
	else{

		// We need to execute the query, cache it and return the cached object
		$execute = $aulis['db']->query($sql);

		// If the rowCount is 0, we can just create an empty cached query
		if($execute->rowCount() == 0)
			$cache_query = new au_class_cached_query();

		// Otherwise we need to do a little more...
		else{

			// Fetching the objects in order to cache them
			$objects  = array();
			
			while($object = $execute->fetchObject()){
				$objects[] = $object;
			}

			// Create the cached query
			$cache_query = new au_class_cached_query($objects, $execute->rowCount());


		}

		// Cache the whole thing, if we cannot do that, we need to fallback
		if(!file_put_contents($cache_file, serialize($cache_query)))
			return au_query($original_sql, true);

		return $cache_query;

	}

}


function au_db_escape($value){
	global $aulis;

	// Return a proper escaped version of our value
	return trim($aulis['db']->quote($value), "'");

}


// For some change, this is not a function, but a simple class that contains information about cached queries
class au_class_cached_query implements Iterator {


	private $_row_count = -1;
	private $_array_count = 0;
	private $_db_objects = null;
	private $position = -1;


   function __construct($db_objects = array(), $row_count = 0) {
       $this->_row_count = $row_count;
       $this->_db_objects = $db_objects;
       $this->_db_objects = new ArrayObject($db_objects);
   }

   function rowCount(){
   		return $this->_row_count;
   }

   function fetchObject(){
   		return $this->current();
   }

    function rewind() {
        $this->position = -1;
    }

    function current() {
    	$this->next();
        return @$this->_db_objects[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->_db_objects[$this->position]);
    }

}