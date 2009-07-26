<?php require_once("../../Connections/pravo.php"); ?>
<?php include("../../util/misc.php"); ?>
<?php
     header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
     header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
     header ("Cache-Control: no-cache, must-revalidate");
     header ("Pragma: no-cache");
     
     header("content-type: application/x-javascript; charset=UTF-8");
	 
	 $data=$_GET['data'];
     $val=$_GET['val'];
	 $sel=$_GET['sel'];
	 mysql_select_db($database_pravo, $pravo);
	 $i=0;
	 if ($data=='category') { 
		if($i==0){
			echo "<script language=Javascript>window.onLoad=dochange('subcategory', '19');</script>";
		}
	 	echo "<select name='category' style='width:300px;' onChange=\"dochange('subcategory', this.value,".$sel.")\">\n";
        echo "<option value='0'>Категорија</option>\n";
		$query = "SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND id_supergroup is NULL";
        $result=mysql_query($query, $pravo) or die(mysql_error());
        while(list($id, $name)=mysql_fetch_array($result)){
               echo "<option value=\"$id\" ";
			   if (!(strcmp($id, htmlentities($sel, ENT_COMPAT, '')))) {echo "SELECTED"; $i++;}
			   echo ">$name</option> \n" ;
        }		
	 }elseif ($data=='subcategory') {
		 $query1 = sprintf("SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND id_supergroup = %s", GetSQLValueString($val, "int"));
	   	$result = mysql_query($query1, $pravo) or die(mysql_error());     
		echo "<select name='subcategory' ";
		if($sel<0 && mysql_num_rows($result)==0) echo "disabled='disabled'";
		echo " style='width:300px;' onChange=\"dochange('subsubcategory', this.value,".$sel.")\">\n"; //onChange=\"dochange('tumbon', this.value)
        echo "<option value='0'>Подкатегорија</option>\n";	                            
       	while(list($id, $name)=mysql_fetch_array($result)){       
               echo "<option value=\"$id\" ";
			   if (!(strcmp($id, htmlentities($sel, ENT_COMPAT, '')))) {echo "SELECTED";}
			   echo ">$name</option> \n" ;
        }
	 } elseif ($data=='subsubcategory') {
		 	$query2 = sprintf("SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND id_supergroup = %s", GetSQLValueString($val, "int"));
	   	$result = mysql_query($query2, $pravo) or die(mysql_error());
		echo "<select name='subsubcategory' ";
		if($sel<0 && mysql_num_rows($result)==0) echo "disabled='disabled'";
		echo " style='width:300px;' \">\n"; //onChange=\"dochange('tumbon', this.value)
        echo "<option value='0'>Под-подкатегорија</option>\n";
                                       
       	while(list($id, $name)=mysql_fetch_array($result)){       
               echo "<option value=\"$id\" ";
			   if (!(strcmp($id, htmlentities($sel, ENT_COMPAT, '')))) {echo "SELECTED";}
			   echo ">$name</option> \n" ;
        }
	 }
	 echo "</select>\n"; 
	 
?>