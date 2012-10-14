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
class CategoriesService {

	var $username = "righttoknowdb";
	var $password = "rightoKnow2012";
	var $server = "localhost";
	var $port = "";
	var $databasename = "righttoknowdb";
	var $tablename = "categories";

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
	 * Returns all the rows from the table.
	 *
	 * Add authroization or any logical checks for secure access to your data 
	 *
	 * @return array
	 */
	public function getAllCategories() {

		$stmt = mysqli_prepare($this->connection, "SELECT * FROM $this->tablename");		
		$this->throwExceptionOnError();
		
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		$rows = array();
		
		mysqli_stmt_bind_result($stmt, $row->id, $row->name, $row->parent);
		
	    while (mysqli_stmt_fetch($stmt)) {
	      $rows[] = $row;
	      $row = new stdClass();
	      mysqli_stmt_bind_result($stmt, $row->id, $row->name,  $row->parent);
	    }
		
		mysqli_stmt_free_result($stmt);
	    mysqli_close($this->connection);
	
	    return $rows;
	}
	
	public function getCategoriesMenu() {
		$dom = new DomDocument();
		$dom->formatOutput = true;
		$root = $dom->createElement( "menus" );
		$dom->appendChild( $root );

		$stmt = mysqli_prepare($this->connection, "SELECT * FROM $this->tablename ");		
		$this->throwExceptionOnError();
		
		
		mysqli_stmt_execute($stmt);
		$this->throwExceptionOnError();
		
		$rows = array();
		$rows2 = array();
		
		mysqli_stmt_bind_result($stmt, $row->id, $row->name, $row->parent);
		
	    while (mysqli_stmt_fetch($stmt)) {
	      $rows[] = $row;
	      $row = new stdClass();
	      mysqli_stmt_bind_result($stmt, $row->id, $row->name, $row->parent);
		
	    }
		
		mysqli_stmt_free_result($stmt);

		/*
		$menu = array();
		foreach($rows as $item){
		 
		 $menu = $dom->createElement( "menu");
		 $menu->setAttribute( 'id', $item->id );
		 $menu->setAttribute( 'name', $item->name );
		 $menu->setAttribute( 'parent', $item->parent );
	
		 $stmt = mysqli_prepare($this->connection, "SELECT * FROM entry_sets where id_category = ?");		
		 $this->throwExceptionOnError();
		  
		  mysqli_stmt_bind_param($stmt, 'i', $item->id);
          $this->throwExceptionOnError();
		
		  mysqli_stmt_execute($stmt);
		  $this->throwExceptionOnError();
		  
		  
		  mysqli_stmt_bind_result($stmt, $row->id, $row->name, $row->id_category);
		  
		  while (mysqli_stmt_fetch($stmt)) {
			$rows2[] = $row;
			$item->menuitem = $row;
			
			$item2 = $dom->createElement( "item");
			$item2->setAttribute( 'id', $row->id );
			$item2->setAttribute( 'name', $row->name);
			$item2->setAttribute( 'parent', $row->id_category );
			
			$menu->appendChild( $item2 );
			$row = new stdClass();
			mysqli_stmt_bind_result($stmt, $row->id, $row->name, $row->id_category);
			
		  }
		  
		   $root->appendChild( $menu );
		  // $menu["menu"] = $item;
		}
		
		mysqli_stmt_free_result($stmt);
		*/
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
