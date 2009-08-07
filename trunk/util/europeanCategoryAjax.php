<?php require_once("../Connections/pravo.php"); ?>
<?php include("../util/misc.php"); ?>
<?php
     //¡ÓË¹´ãËé IE ÍèÒ¹ page ¹Õé·Ø¡¤ÃÑé§ äÁèä»àÍÒ¨Ò¡ cache
     header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
     header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
     header ("Cache-Control: no-cache, must-revalidate");
     header ("Pragma: no-cache");
     
     header("content-type: application/x-javascript; charset=UTF-8");
	 
	 $data=$_GET['data'];
     $val=$_GET['val'];
	 $type=$_GET['type'];
	 mysql_select_db($database_pravo, $pravo);
	 
	 if ($data=='category1') { 
	 	echo "<select name='category1' style='width:320px;' onChange=\"dochange1('subcategory1', this.value)\">\n";
        echo "<option value='0'>Изберете категорија</option>\n";
		$query = sprintf("SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND dt.id_doc_type=%s AND id_supergroup is NULL",GetSQLValueString($type, "int"));
        $result=mysql_query($query, $pravo) or die(mysql_error());
        while(list($id, $name)=mysql_fetch_array($result)){
               echo "<option value=\"$id\" >$name</option> \n" ;
        }	
	 }else if ($data=='subcategory1') {
		 $query1 = sprintf("SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND dt.id_doc_type=%s AND id_supergroup = %s", GetSQLValueString($type, "int"), GetSQLValueString($val, "int"));
	   	$result = mysql_query($query1, $pravo) or die(mysql_error());     
		echo "<select name='subcategory1' ";
		if(mysql_num_rows($result)<=0) echo "disabled='disabled'";
		echo " style='width:320px;' onChange=\"dochange1('subsubcategory1', this.value)\">\n"; //onChange=\"dochange('tumbon', this.value)
        echo "<option value='0'>Изберете подкатегорија</option>\n";	                            
       	while(list($id, $name)=mysql_fetch_array($result)){       
               echo "<option value=\"$id\" >$name</option> \n" ;
        }
	 } else if ($data=='subsubcategory1') {
		 	$query2 = sprintf("SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND dt.id_doc_type=%s AND id_supergroup = %s", GetSQLValueString($type, "int"), GetSQLValueString($val, "int"));
	   	$result = mysql_query($query2, $pravo) or die(mysql_error());
		echo "<select name='subsubcategory1' ";
		if(mysql_num_rows($result)<=0) echo "disabled='disabled'";
		echo " style='width:320px;' \">\n"; //onChange=\"dochange('tumbon', this.value)
        echo "<option value='0'>Изберете под-подкатегорија</option>\n";
                                       
       	while(list($id, $name)=mysql_fetch_array($result)){       
               echo "<option value=\"$id\" >$name</option> \n" ;
        }
	 }
	 echo "</select>\n"; 
	 
?>