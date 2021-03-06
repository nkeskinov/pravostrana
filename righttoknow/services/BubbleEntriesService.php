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
class BubbleEntriesService {

	var $username = "righttoknow";
	var $password = "righttoknow";
	var $server = "localhost";
	var $port = "3306";
	var $databasename = "righttoknow";
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
	  							$this->databasename,
	  							$this->port
	  						);
        mysqli_character_set_name('utf8');

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
	public function getBubbleEntriesByIds($x_axis, $y_axis, $year) {

		$stmt = mysqli_prepare($this->connection,
                    "select x_entry_set.`value` as x, y_entry_set.`value` as y, municipalities.`name`, x_entry_set.`year` ".
                    "from $this->tablename as x_entry_set, $this->tablename as y_entry_set, municipalities ".
                    "where x_entry_set.id_entry_set = ? ".
                        "and y_entry_set.id_entry_set = ? ".
                        "and x_entry_set.`year` = y_entry_set.`year` ".
                        "and x_entry_set.id_municipality = y_entry_set.id_municipality ".
                        "and x_entry_set.id_municipality = municipalities.id_municipality ".
                        "and x_entry_set.year = ? ".
                    "order by `year` asc");
		$this->throwExceptionOnError();

        mysqli_stmt_bind_param($stmt, 'iii', $x_axis, $y_axis, $year);
        $this->throwExceptionOnError();
		
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		$rows = array();

		mysqli_stmt_bind_result($stmt, $row->x, $row->y, $row->name, $row->year);

	    while (mysqli_stmt_fetch($stmt)) {
	      $rows[] = $row;
	      $row = new stdClass();
	      mysqli_stmt_bind_result($stmt, $row->x, $row->y, $row->name, $row->year);
	    }

		mysqli_stmt_free_result($stmt);
	    mysqli_close($this->connection);
	
	    return $rows;
	}

    /**
     * Returns all the rows from the table.
     *
     * Add authroization or any logical checks for secure access to your data
     *
     * @return array
     */
    public function getBubbleEntriesPerYearByIds($x_axis, $y_axis) {

        $stmt = mysqli_prepare($this->connection,
            "select x_entry_set.`value` as x, y_entry_set.`value` as y, municipalities.`name`, x_entry_set.`year` ".
                "from $this->tablename as x_entry_set, $this->tablename as y_entry_set, municipalities ".
                "where x_entry_set.id_entry_set = ? ".
                "and y_entry_set.id_entry_set = ? ".
                "and x_entry_set.`year` = y_entry_set.`year` ".
                "and x_entry_set.id_municipality = y_entry_set.id_municipality ".
                "and x_entry_set.id_municipality = municipalities.id_municipality ".
                "order by `year` asc");
        $this->throwExceptionOnError();

        mysqli_stmt_bind_param($stmt, 'ii', $x_axis, $y_axis);
        $this->throwExceptionOnError();

        mysqli_stmt_execute($stmt);
        $this->throwExceptionOnError();

        $rows = array();

        mysqli_stmt_bind_result($stmt, $entry->x, $entry->y, $entry->name, $year);

        while (mysqli_stmt_fetch($stmt)) {
            $rows[$year][] = $entry;
            $entry = new stdClass();
            mysqli_stmt_bind_result($stmt, $entry->x, $entry->y, $entry->name, $year);
        }

        mysqli_stmt_free_result($stmt);
        mysqli_close($this->connection);

        return $rows;
    }

    public function getPossibleYears($x_axis, $y_axis) {

        $stmt = mysqli_prepare($this->connection,
            "select distinct `year` ".
                "from $this->tablename ".
                "where id_entry_set = ? ".
                "or id_entry_set = ? ".
                "order by `year` asc");
        $this->throwExceptionOnError();

        mysqli_stmt_bind_param($stmt, 'ii', $x_axis, $y_axis);
        $this->throwExceptionOnError();

        mysqli_stmt_execute($stmt);
        $this->throwExceptionOnError();

        $rows = array();

        mysqli_stmt_bind_result($stmt, $row->year);

        while (mysqli_stmt_fetch($stmt)) {
            $rows[] = $row;
            $row = new stdClass();
            mysqli_stmt_bind_result($stmt, $row->year);
        }

        mysqli_stmt_free_result($stmt);
        mysqli_close($this->connection);

        return $rows;
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

?>
