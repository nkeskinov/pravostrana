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
class EntrysetsService {

	var $username = "righttoknowdb";
	var $password = "rightoKnow2012";
	var $server = "localhost";
	var $port = "";
	var $databasename = "righttoknowdb";
	var $tablename = "entry_sets";

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

		 $stmt = mysqli_prepare($this->connection, "set names 'utf8'");
        $this->throwExceptionOnError();

        mysqli_stmt_execute($stmt);

		$this->throwExceptionOnError($this->connection);
	}
	
	/**
	 * Returns an XML string for the EntrySet Menu
	 *
	 * @return EntrySetsMenu
	 */
	public function getEntrySetMenu() {
		
		$stmt = mysqli_prepare($this->connection, "SELECT * FROM $this->tablename ORDER BY id_entry_set");		
		$this->throwExceptionOnError();
		
		// execute SQL
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		// initialize result to the corresponding return type
		$result = new EntrySetsMenu; 
		$result->default_x = null;
		$result->default_x_en = null;
		$result->default_x_sq = null;
		$result->default_y = null;
		$result->default_y_en = null;
		$result->default_y_sq = null;
		$result->default_z = null; 
		$result->default_z_en = null; 
		$result->default_z_en = null; 
		$result->default_x_id = null;
		$result->default_y_id = null;
		$result->default_z_id = null;
		$result->x_axis = null;
		$result->y_axis = null;
		$result->default_tab = null;
		$result->menu =  array();
		$rows = array();
		
		// bind result to a helper object and fetch actual data
        mysqli_stmt_bind_result($stmt, $entry->id_entry_set, $entry->name, $entry->name_en, $entry->name_sq, $entry->default_x, $entry->default_y, $entry->default_z, $entry->parent);
		
        while (mysqli_stmt_fetch($stmt)) {
		  if($entry->default_x != null){ 
			if($entry->default_x == 1)
				$result->x_axis = "lin";
			else if($entry->default_x == 2)
				$result->x_axis = "log";
			$result->default_x_id = $entry->id_entry_set;
			$result->default_x = $entry->name;
			$result->default_x_en = $entry->name_en;
			$result->default_x_sq = $entry->name_sq;
		  }
		  if($entry->default_y != null){
		  if($entry->default_y == 1)
				$result->y_axis = "lin";
			else if($entry->default_y == 2)
				$result->y_axis = "log";
			$result->default_y_id = $entry->id_entry_set;
			$result->default_y = $entry->name;
			$result->default_y_en = $entry->name_en;
			$result->default_y_sq = $entry->name_sq;
		  }
		  if($entry->default_z != null){
			if($entry->default_z == 1)
				$result->default_tab = 0;
			else if($entry->default_z == 2)
				$result->default_tab = 1;
			$result->default_z_id = $entry->id_entry_set;
			$result->default_z = $entry->name;
			$result->default_z_en = $entry->name_en;
			$result->default_z_sq = $entry->name_sq;
		  }
		  
		  $menuItem = new stdClass();
		  $menuItem->label = $entry->name;
		  $menuItem->label_en = $entry->name_en;
		  $menuItem->label_sq = $entry->name_sq;
		  $menuItem->id = $entry->id_entry_set;
		  
			
		  /*$rows[$entry->id_entry_set] = &$menuItem;
		  if ($entry->parent == null || $entry->parent == 0) {
		      $result->menu[] = &$menuItem;
		  } else {
			  $parentMenuItem = &$rows[$entry->parent];
			  if ($parentMenuItem->children == null) {
				  $parentMenuItem->children = array();
			  }
			  $parentMenuItem->children[] = &$menuItem;
		  }*/
		  
		  $rows[$entry->id_entry_set] = $menuItem;
		  if ($entry->parent == null || $entry->parent == 0) {
		      $result->menu[] = $menuItem;
		  } else {
			  $parentMenuItem = $rows[$entry->parent];
			  if (!isset($parentMenuItem->children)) {
				  $parentMenuItem->children = array();
			  }
			  $parentMenuItem->children[] = $menuItem;
		  }
		  
	      $entry = new stdClass();
	      mysqli_stmt_bind_result($stmt, $entry->id_entry_set, $entry->name, $entry->name_en, $entry->name_sq, $entry->default_x, $entry->default_y, $entry->default_z,  $entry->parent);
	    }
		
		mysqli_stmt_free_result($stmt);
		
        mysqli_close($this->connection);
		
		return $result;
	}

	/**
	 * Returns all the rows from the table.
	 *
	 * Add authroization or any logical checks for secure access to your data 
	 *
	 * @return array
	 */
	public function getAllEntry_sets() {

		$stmt = mysqli_prepare($this->connection, "SELECT * FROM $this->tablename ORDER BY id_entry_sets");		
		$this->throwExceptionOnError();
		
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		$rows = array();
		
		mysqli_stmt_bind_result($stmt, $row->id_entry_set, $row->name, $row->default_x, $row->default_y, $row->parent);
		
	    while (mysqli_stmt_fetch($stmt)) {
	      $rows[] = $row;
	      $row = new stdClass();
	      mysqli_stmt_bind_result($stmt, $row->id_entry_set, $row->name, $row->default_x, $row->default_y, $row->parent);
	    }
		
		mysqli_stmt_free_result($stmt);
	    mysqli_close($this->connection);
	
	    return $rows;
	}

	/**
	 * Returns the item corresponding to the value specified for the primary key.
	 *
	 * Add authorization or any logical checks for secure access to your data 
	 *
	 * 
	 * @return stdClass
	 */
	public function getEntry_setsByID($itemID) {
		
		$stmt = mysqli_prepare($this->connection, "SELECT * FROM $this->tablename where id_entry_set=?");
		$this->throwExceptionOnError();
		
		mysqli_stmt_bind_param($stmt, 'i', $itemID);		
		$this->throwExceptionOnError();
		
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		mysqli_stmt_bind_result($stmt, $row->id_entry_set, $row->name, $row->default_x, $row->default_y, $row->parent);
		
		if(mysqli_stmt_fetch($stmt)) {
	      return $row;
		} else {
	      return null;
		}
	}

	/**
	 * Returns the item corresponding to the value specified for the primary key.
	 *
	 * Add authorization or any logical checks for secure access to your data 
	 *
	 * 
	 * @return stdClass
	 */
	public function createEntry_sets($item) {

		$stmt = mysqli_prepare($this->connection, "INSERT INTO $this->tablename (name, default_x, default_y, parent) VALUES (?, ?, ?, ?)");
		$this->throwExceptionOnError();

		mysqli_stmt_bind_param($stmt, 'siii', $item->name, $item->default_x, $item->default_y, $item->parent);
		$this->throwExceptionOnError();

		mysqli_stmt_execute($stmt);		
		$this->throwExceptionOnError();

		$autoid = mysqli_stmt_insert_id($stmt);

		mysqli_stmt_free_result($stmt);		
		mysqli_close($this->connection);

		return $autoid;
	}

	/**
	 * Updates the passed item in the table.
	 *
	 * Add authorization or any logical checks for secure access to your data 
	 *
	 * @param stdClass $item
	 * @return void
	 */
	public function updateEntry_sets($item) {
	
		$stmt = mysqli_prepare($this->connection, "UPDATE $this->tablename SET name=?, default_x=?, default_y=?, parent=? WHERE id_entry_set=?");		
		$this->throwExceptionOnError();
		
		mysqli_stmt_bind_param($stmt, 'siiii', $item->name, $item->default_x, $item->default_y, $item->parent, $item->id_entry_set);		
		$this->throwExceptionOnError();

		mysqli_stmt_execute($stmt);		
		$this->throwExceptionOnError();
		
		mysqli_stmt_free_result($stmt);		
		mysqli_close($this->connection);
	}

	/**
	 * Deletes the item corresponding to the passed primary key value from 
	 * the table.
	 *
	 * Add authorization or any logical checks for secure access to your data 
	 *
	 * 
	 * @return void
	 */
	public function deleteEntry_sets($itemID) {
				
		$stmt = mysqli_prepare($this->connection, "DELETE FROM $this->tablename WHERE id_entry_set = ?");
		$this->throwExceptionOnError();
		
		mysqli_stmt_bind_param($stmt, 'i', $itemID);
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		mysqli_stmt_free_result($stmt);		
		mysqli_close($this->connection);
	}


	/**
	 * Returns the number of rows in the table.
	 *
	 * Add authorization or any logical checks for secure access to your data 
	 *
	 * 
	 */
	public function count() {
		$stmt = mysqli_prepare($this->connection, "SELECT COUNT(*) AS COUNT FROM $this->tablename");
		$this->throwExceptionOnError();

		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		mysqli_stmt_bind_result($stmt, $rec_count);
		$this->throwExceptionOnError();
		
		mysqli_stmt_fetch($stmt);
		$this->throwExceptionOnError();
		
		mysqli_stmt_free_result($stmt);
		mysqli_close($this->connection);
		
		return $rec_count;
	}


	/**
	 * Returns $numItems rows starting from the $startIndex row from the 
	 * table.
	 *
	 * Add authorization or any logical checks for secure access to your data 
	 *
	 * 
	 * 
	 * @return array
	 */
	public function getEntry_sets_paged($startIndex, $numItems) {
		
		$stmt = mysqli_prepare($this->connection, "SELECT * FROM $this->tablename LIMIT ?, ?");
		$this->throwExceptionOnError();
		
		mysqli_stmt_bind_param($stmt, 'ii', $startIndex, $numItems);
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		$rows = array();
		
		mysqli_stmt_bind_result($stmt, $row->id_entry_set, $row->name, $row->default_x, $row->default_y, $row->parent);
		
	    while (mysqli_stmt_fetch($stmt)) {
	      $rows[] = $row;
	      $row = new stdClass();
	      mysqli_stmt_bind_result($stmt, $row->id_entry_set, $row->name, $row->default_x, $row->default_y, $row->parent);
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

class EntrySetsMenu{
	public $default_x;
	public $default_x_id;
	public $default_y;
	public $default_y_id;
	public $x_axis;
	public $y_axis;
	public $default_tab;
	public $menu;
}

?>
