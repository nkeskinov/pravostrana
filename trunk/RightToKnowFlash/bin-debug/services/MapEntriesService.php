<?php

/**
 *  README for sample service
 *
 *  This generated sample service contains functions that illustrate typical service operations.
 *  Use these functions as a starting point for creating your own service implementation. Modify the 
 *  function signatures, references to the database, and implementation according to your needs. 
 *  Delete the functions that you do not use.
 *
 *  Save your changes and return to Flash Builder. In Flash Builder Data/Services View, refresh 
 *  the service. Then drag service operations onto user interface components in Design View. For 
 *  example, drag the getAllItems() operation onto a DataGrid.
 *  
 *  This code is for prototyping only.
 *  
 *  Authenticate the user prior to allowing them to call these methods. You can find more 
 *  information at http://www.adobe.com/go/flex_security
 *
 */
class MapEntriesService {

	var $username = "righttoknowdb";
	var $password = "rightoKnow2012";
	var $server = "localhost";
	var $port = "3306";
	var $databasename = "righttoknowdb";
	var $tablename = "entries";

	var $connection;

	/**
	 * The constructor initializes the connection to database. Everytime a request is 
	 * received by Zend AMF, an instance of the service class is created and then the
	 * requested method is invoked.
	 */
	public function __construct() {
	  	$this->connection = mysqli_connect(
	  							$this->server,  
	  							$this->username,  
	  							$this->password, 
	  							$this->databasename
	  						);
       // mysqli_character_set_name('utf8');

        $stmt = mysqli_prepare($this->connection, "set names 'utf8'");
        $this->throwExceptionOnError();

        mysqli_stmt_execute($stmt);

		$this->throwExceptionOnError($this->connection);
	}

	/**
	 * Returns all the rows from the table.
	 *
	 * Add authroization or any logical checks for secure access to your data 
	 *
	 * @return array
	 */
	public function getMapEntriesByIds($value1, $value2) {

		$stmt = mysqli_prepare($this->connection,
                    "select entry1.value/entry2.value as value, entry1.value as entry1, entry2.value as entry2, entry1.`year` as year, municipalities.`name` as title, municipalities.map_id as instanceName ".
                    "from $this->tablename as entry1, $this->tablename as entry2,  municipalities ".
                    "where entry1.id_entry_set = ? ".
						"and entry2.id_entry_set = ? ".
						"and entry1.year = entry2.year ".
                        "and entry1.id_municipality = municipalities.id_municipality ".
						"and entry2.id_municipality = municipalities.id_municipality ".
                    " order by entry1.`year`, municipalities.`id_municipality` asc");
		$this->throwExceptionOnError();

        mysqli_stmt_bind_param($stmt, 'ii', $value1, $value2);
        $this->throwExceptionOnError();
		
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		// initialize result to the corresponding return type
        $result = new MapEntryResult;
		// initialize internal result field
        $result->rows = array();
		
		
		mysqli_stmt_bind_result($stmt, $entry->value, $entry->entry1, $entry->entry2, $year, $entry->title, $entry->instanceName);
		mysqli_stmt_fetch($stmt);
		
		$entry->value = $entry->value + 0.0;
		$entry->entry1 = $entry->entry1 + 0.0;
		$entry->entry2 = $entry->entry2 + 0.0;
		
		$result->minYear = $year;
        $result->maxYear = $year;
       
		// insert first row
        $result->rows[0][] = $entry;
		// initialize new empty object
        $entry = new stdClass();
		mysqli_stmt_bind_result($stmt, $entry->value, $entry->entry1, $entry->entry2,  $year, $entry->title, $entry->instanceName);
		
	    while (mysqli_stmt_fetch($stmt)) {
	     	
			$entry->value = $entry->value + 0.0;
			
            if ($year < $result->minYear) {
                $result->minYear = $year;
            }
            if ($year > $result->maxYear) {
                $result->maxYear = $year;
            }
			// insert row
            $result->rows[$year - $result->minYear][] = $entry;
			
			$entry = new stdClass();
			
	      mysqli_stmt_bind_result($stmt, $entry->value,$entry->entry1, $entry->entry2,  $year, $entry->title, $entry->instanceName);
	    }
		
		mysqli_stmt_free_result($stmt);
	    mysqli_close($this->connection);
	
	    return $result;
	}

	/**
	 * Utility function to throw an exception if an error occurs 
	 * while running a mysql command.
	 */
	private function throwExceptionOnError($link = null) {
		if($link == null) {
			$link = $this->connection;
		}
		if(mysqli_error($link)) {
			$msg = mysqli_errno($link) . ": " . mysqli_error($link);
			throw new Exception('MySQL Error - '. $msg);
		}		
	}
}


class MapEntryResult{
	public $minYear;
	public $maxYear;
	public $rows;
}

class MapEntry{
	public $instanceName;
	public $title;
	public $value;
	public $year;
}
?>
