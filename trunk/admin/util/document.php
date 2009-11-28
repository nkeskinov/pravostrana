<?php require("../util/uploader.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
	$_SESSION['edit']="-1";
if(isset($_GET['id']))
	$_SESSION['edit']="edit";
	
//echo $_SESSION['edit'];
mysql_select_db($database_pravo, $pravo);

if (isset($_GET['id_document']) && isset($_GET['id_doc_type']) && isset($_GET['into_force']) && $_GET['id_document'] != '0' && $_GET['id_doc_type'] == '1') {
	$query_IntoForce = sprintf("UPDATE document SET into_force = %s WHERE id_document = %s AND id_doc_type = 1", GetSQLValueString($_GET['into_force'], "int"), GetSQLValueString($_GET['id_document'], "int"));
	mysql_query($query_IntoForce, $pravo) or die(mysql_error());
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
$query_Recordset1 = sprintf("SELECT * FROM `document` d LEFT JOIN doc_meta dm ON (d.id_doc_meta=dm.id_doc_meta)  WHERE  id_document = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


$query_DocGroup=sprintf("SELECT id_doc_group, name
						FROM doc_group
						WHERE id_doc_group = (
							SELECT id_supergroup
							FROM doc_group
							WHERE id_doc_group = (
								SELECT id_supergroup
								FROM doc_group
								WHERE id_doc_group = %s
							)
						)						UNION
						SELECT id_doc_group, name
						FROM doc_group
						WHERE id_doc_group = (
							SELECT id_supergroup
							FROM doc_group
							WHERE id_doc_group = %s
						)UNION
						SELECT id_doc_group, name FROM doc_group
						WHERE id_doc_group = %s 
						",GetSQLValueString($row_Recordset1['id_doc_group'],"int"),GetSQLValueString($row_Recordset1['id_doc_group'],"int"),GetSQLValueString($row_Recordset1['id_doc_group'],"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
//$row_DocGroup = mysql_fetch_assoc($DocGroup);
$row_number =  mysql_num_rows($DocGroup);
$cat=-1;
$subcat=-1;
$subsubcat=-1;
if($row_number==3){
	$cat=mysql_result($DocGroup,0,'id_doc_group');
	$subcat=mysql_result($DocGroup,1,'id_doc_group');
	$subsubcat=mysql_result($DocGroup,2,'id_doc_group');
}elseif($row_number==2){
	$cat=mysql_result($DocGroup,0,'id_doc_group');
	$subcat=mysql_result($DocGroup,1,'id_doc_group');
}elseif($row_number==1){
	$cat=mysql_result($DocGroup,0,'id_doc_group');
}


$query_RecordsetKeyword = sprintf("SELECT k.val FROM keyword k, document_has_keyword dk, document d WHERE dk.id_keyword=k.id_keyword AND dk.id_document=d.id_document AND d.id_document=%s", GetSQLValueString($colname_Recordset1, "int"));
$RecordsetKeyword = mysql_query($query_RecordsetKeyword, $pravo) or die(mysql_error());
$row_RecordsetKeyword = mysql_fetch_assoc($RecordsetKeyword);
$totalRows_RecordsetKeyword = mysql_num_rows($RecordsetKeyword);


$query_DocumentGroups = "SELECT * FROM doc_group ORDER BY id_doc_group";
$DocumentGroups = mysql_query($query_DocumentGroups, $pravo) or die(mysql_error());
$row_DocumentGroups = mysql_fetch_assoc($DocumentGroups);
$totalRows_DocumentGroups = mysql_num_rows($DocumentGroups);

mysql_select_db($database_pravo, $pravo);
$query_DocumentTypes = "SELECT * FROM doc_type";
$DocumentTypes = mysql_query($query_DocumentTypes, $pravo) or die(mysql_error());
$row_DocumentTypes = mysql_fetch_assoc($DocumentTypes);
$totalRows_DocumentTypes = mysql_num_rows($DocumentTypes);
?>
<div align="left" style="height:22px; width:99%; border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table cellpadding="0" cellspacing="0">
  <tr></tr>
  <tr>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="documents.php"><img src="../images/new.png" border="0" title="Нов документ" /></a></div></td>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/save.png" border="0" title="Зачувај документ" /></a></div></td>
    <td>
    <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="documentlaws.php?id=<?php echo $row_Recordset1['id_document']; ?>&id_doc_type=<?php echo $row_Recordset1['id_doc_type']; ?>&id_doc_meta=<?php echo $row_Recordset1['id_doc_meta']; ?>&delete=true" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="../images/delete.png" border="0" title="Бриши"  /></a></div>
    </td>
    <td><div style="width:26px; height:21px; padding-top:1.5px; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/print.png" border="0" title="Печати страна" /></a></div></td>
  </tr>
  </table>
</div>
   <br />
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	mysql_select_db($database_pravo, $pravo);

	 $query        = "SET AUTOCOMMIT=0";
     $result_query = @mysql_query($query, $pravo);
		 
	 $query        = "BEGIN";
     $result_query = @mysql_query($query, $pravo);
	 $success=true;
	 
	$DocTypeQuery = sprintf("SELECT * FROM doc_type WHERE id_doc_type=%s", GetSQLValueString($_POST['id_doc_type'],"int"));
	$DocType = mysql_query($DocTypeQuery, $pravo) or die(mysql_error());
	$directory = mysql_result($DocType,0,'directory');
	
	$filetype = $_SESSION['filetype'];
	$filename = $_SESSION['filename'];
	$filesize = $_SESSION['filesize'];
	$ext =  substr(strrpos($filetype,"/"),3);
	$old = "../download/tmp/".$filename;
	$new = "../download/".$directory."/".$filename;
	if(!file_exists($new)){
		rename($old,$new); //move the file from the tmp folder
		$message = "Документот ".$new." e закачен!";
		_show_message_color($message,'YELLOW');  	
	}
	//echo $_POST['keywords'];
	$published_date = date("Y-m-d", strtotime($_POST['published_date']));
	
	$created_by = isset($_SESSION['MM_ID']) ? $_SESSION['MM_ID'] : 0 ;
	/* Inserts the meta data for the document sl. vesnik and year */
	
	$checkMeta = sprintf("SELECT * FROM doc_meta where ordinal = %s and `date` = %s",GetSQLValueString($_POST['ordinal'], "int"),GetSQLValueString($published_date, "date"));
	$Result5 = mysql_query($checkMeta, $pravo) or die(mysql_error());
	if(mysql_num_rows($Result5)>0){
		$id_doc_meta =mysql_result($Result5,0,'id_doc_meta');
	}else{
	$insertSQL = sprintf("INSERT INTO doc_meta (id_doc_type, ordinal, `date`) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id_doc_type'], "int"),
                       GetSQLValueString($_POST['ordinal'], "int"),
                       GetSQLValueString($published_date, "date"));
	 
  	$Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
	
	 if($Result1){
		 $id_doc_meta = mysql_insert_id();
	 	}
	}
		/* Insert new document*/
		if(isset($_POST['subsubcategory']) && $_POST['subsubcategory']!=0){
			$id_group=$_POST['subsubcategory'];
		}elseif(isset($_POST['subcategory']) && $_POST['subcategory']!=0){
			$id_group=$_POST['subcategory'];
		}elseif(isset($_POST['category']) && $_POST['category']!=0)
			$id_group=$_POST['category'];
		
		//echo $_POST['subsubcategory']."<br>";
		//echo $_POST['subcategory']."<br>";
		//echo $_POST['category']."<br>";		
		//echo $id_group;
		$into_force_date = '';
		$into_force = '';
		if ($_POST['id_doc_type'] == '1') {
			$into_force_date = date("Y-m-d", strtotime($_POST['into_force_date']));
			$into_force = '1';
		}
		$idx = isset($_POST['idx']) ? $_POST['idx'] : "";

		$insertSQL = sprintf("INSERT INTO `document` (id_doc_type, filename, title, id_doc_group, `description`, extension, filesize, mimetype, forcesubscribe, published_date, created_by, id_doc_meta, uploaded_date, into_force_date, into_force, idx) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['id_doc_type'], "int"),
						   GetSQLValueString($filename, "text"),
						   GetSQLValueString($_POST['title'], "text"),
						   GetSQLValueString($id_group, "int"),
						   GetSQLValueString($_POST['description'], "text"),
						   GetSQLValueString($ext, "text"),
						   GetSQLValueString($filesize, "int"),
						   GetSQLValueString($filetype, "text"),
						   GetSQLValueString(isset($_POST['forcesubscribe']) ? "true" : "", "defined","1","0"),
						   GetSQLValueString($published_date , "date"),
						   GetSQLValueString($created_by, "int"),
						   GetSQLValueString($id_doc_meta,"int"),
						   GetSQLValueString(date('Y-m-d H:i'), "date"),
						   GetSQLValueString($into_force_date, "date"),
						   GetSQLValueString($into_force, "defined", '1', 'NULL'),
						   GetSQLValueString($idx, "text"));
	
	  
	  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
	  $id_doc=mysql_insert_id();
	  if($Result1){
			  $keywords_arr=explode(",", $_POST['keywords']);
			//print_r($keywords_arr);
			
			foreach($keywords_arr as $key){
				//echo "key=".str_replace("\n","",str_replace("\t","",$key))."<br>";
				$key1=str_replace("\n","",str_replace("\t","",$key));
				if(strpos($key1," ")==0){
					$key1=substr($key1,1);
					
				}
				$selectSQL= sprintf("SELECT * FROM keyword WHERE val like %s",GetSQLValueString($key1, "text"));
				$Result = mysql_query($selectSQL,$pravo);
				$num=mysql_num_rows($Result);
				if($num!=0){
					$word=mysql_result($Result,0,'val');
					$id_keyword=mysql_result($Result,0,'id_keyword');
				}else{
					$insertKeyword=sprintf("INSERT INTO keyword(val) VALUES(%s)",GetSQLValueString($key1, "text"));
					$ResultKeyword=mysql_query($insertKeyword,$pravo);
					if(!$ResultKeyword)
						$success=false;
					$id_keyword=mysql_insert_id();
					
				}
				$insertKey=sprintf("INSERT INTO document_has_keyword(id_keyword,id_document) VALUES(%s,%s)",
								GetSQLValueString($id_keyword, "int"),
								GetSQLValueString($id_doc, "int"));
				$ResultKey=mysql_query($insertKey,$pravo);
				if(!$ResultKey)
						$success=false;
		
			}
			if(isset($_GET['superdocument']) && $_GET['superdocument'] != ""){
	
					$updateSQL = sprintf("UPDATE `document` SET id_superdoc=%s where id_document = %s",GetSQLValueString($_GET['superdocument'],"int"),GetSQLValueString(mysql_insert_id(),"int"));
					$Result2 = mysql_query($updateSQL, $pravo) or die(mysql_error());
					//$redirect = "../documentDetail.php?id=".$_GET['superdocument']."&page=documentlaws.php";
			
			}//else{
				//$redirect = "../documentDetail.php?id=".$id_doc."&page=documentlaws.php";
			//}
			//header("Location: " .$redirect );
			$success=true;
	  
	 }else{
			$success=false;
	}	
	
	if ($success == true)
	  {
		 $query = "COMMIT";
		 $result_query = @mysql_query($query, $pravo);
	  }else{
		  $query = "ROLLBACK";
		  $result_query = @mysql_query($query, $pravo);
	  }
}

if ((isset($_POST["MM_update"]))) {
	 mysql_select_db($database_pravo, $pravo);
	 $query        = "SET AUTOCOMMIT=0";
     $result_query = @mysql_query($query, $pravo);
		 
	 $query        = "BEGIN";
     $result_query = @mysql_query($query, $pravo);
	 $success=true;
	 
	if($_POST['published_date']!="")
		$published_date = date("Y-m-d", strtotime($_POST['published_date']));
	else
		$published_date="";
	if(isset($_GET['change']) && $_GET['change']="true" ){
		$DocumentQuery=sprintf("SELECT * FROM document where id_document=%s",GetSQLValueString($_GET['id'],"int"));
		$Document = mysql_query($DocumentQuery,$pravo) or die(mysql_error());
		$id_doc_type = mysql_result($Document,0,'id_doc_type');
		$file = mysql_result($Document, 0, 'filename');
		$DocTypeQuery_old = sprintf("SELECT * FROM doc_type WHERE id_doc_type=%s", GetSQLValueString($_POST['id_doc_type'],"int"));
		$DocType_old = mysql_query($DocTypeQuery_old, $pravo) or die(mysql_error());
		$directory_old = mysql_result($DocType_old,0,'directory');
		
		$file_to_unlink = "../download/".$directory_old."/".$file;
		
		if(file_exists($file_to_unlink)){
			unlink($file_to_unlink);
			$message = "Документот ".$file_to_unlink." e избришан!";
			_show_message_color($message,'YELLOW');  	
		}
	
	
	$DocTypeQuery = sprintf("SELECT * FROM doc_type WHERE id_doc_type=%s", GetSQLValueString($_POST['id_doc_type'],"int"));
	$DocType = mysql_query($DocTypeQuery, $pravo) or die(mysql_error());
	$directory = mysql_result($DocType,0,'directory');
	
	$filetype = $_SESSION['filetype'];
	$filename = $_SESSION['filename'];
	$filesize = $_SESSION['filesize'];
	$ext =  substr(strrpos($filetype,"/"),3);
	$old = "../download/tmp/".$filename;
	$new = "../download/".$directory."/".$filename;
	if(!file_exists($new)){
		rename($old,$new); //move the file from the tmp folder
		$message = "Документот ".$new." e закачен!";
		_show_message_color($message,'YELLOW');  	
	}
	}else{
		$filename = $_POST['filename'];	
	}
	$created_by = isset($_SESSION['MM_ID']) ? $_SESSION['MM_ID'] : 0 ;
	
	if(isset($_POST['subsubcategory']) && $_POST['subsubcategory']!=0){
			$id_group=$_POST['subsubcategory'];
		}elseif(isset($_POST['subcategory']) && $_POST['subcategory']!=0){
			$id_group=$_POST['subcategory'];
		}elseif(isset($_POST['category']) && $_POST['category']!=0)
			$id_group=$_POST['category'];
	
//	echo $_POST['subsubcategory']."<br>";
	//echo $_POST['subcategory']."<br>";
	//echo $_POST['category']."<br>";		
	//echo $id_group."<br>";
	
	if ($_POST['into_force_date']!="") {
		$into_force_date =  date("Y-m-d", strtotime($_POST['into_force_date']));
	}else
		$into_force_date = "";
	echo $into_force_date;
  $updateSQL = sprintf("UPDATE `document` SET title=%s, published_date=%s, `description`=%s, id_doc_type=%s, id_doc_group=%s, filename=%s, forcesubscribe=%s, into_force_date=%s WHERE id_document=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($published_date, "date"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['id_doc_type'], "int"),
                       GetSQLValueString($id_group, "int"),
                       GetSQLValueString($filename, "text"),
                       GetSQLValueString(isset($_POST['forcesubscribe']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString($into_force_date, "date"),
					   GetSQLValueString($_POST['id_document'], "int"));

  //echo $updateSQL;
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
  
  /* Update the ordinal and date from the doc_meta*/
  $year = date("d.m.Y",strtotime($_POST['year']));
	$UpdateDocMetaSQL = sprintf("UPDATE `doc_meta` SET ordinal=%s, `date`=%s WHERE `doc_meta`.`id_doc_meta`=%s",
                       GetSQLValueString($_POST['ordinal'], "int"),
                       GetSQLValueString($published_date, "date"),
                       GetSQLValueString($_POST['id_doc_meta'], "int"));
	 
  $ResultDocMeta = mysql_query($UpdateDocMetaSQL, $pravo) or die(mysql_error());
	
  $id_doc=$_POST['id_document'];
  $keywords1=str_replace(", ",",",$_POST['keywords']);
  $keywords_arr=explode(",", $keywords1);
  echo $keywords1;
			print_r($keywords_arr);
			 $deleteIDDocument=sprintf("DELETE FROM document_has_keyword WHERE id_document=%s",GetSQLValueString($id_doc, "int"));
			 $ResultIDDocument1=mysql_query($deleteIDDocument,$pravo);
			 
			foreach($keywords_arr as $key){
				echo "key=".str_replace("\n","",str_replace("\t","",$key))."<br>";
				$key1=str_replace("\n","",str_replace("\t","",$key));
				/*if(strpos($key1," ")==0){
					$key1=substr($key1,1);
					
				}*/
				$selectSQL= sprintf("SELECT * FROM keyword WHERE val=%s",GetSQLValueString($key1, "text"));
				$Result = mysql_query($selectSQL,$pravo);
				$num=mysql_num_rows($Result);
				$id_keyword=-1;
				if($num!=0){
					$word=mysql_result($Result,0,'val');
					$id_keyword=mysql_result($Result,0,'id_keyword');
				}else{
					$insertKeyword=sprintf("INSERT INTO keyword(val) VALUES(%s)",GetSQLValueString($key1, "text"));
					$ResultKeyword=mysql_query($insertKeyword,$pravo);
					if(!$ResultKeyword)
						$success=false;
					$id_keyword=mysql_insert_id();
					
				}
			 
				$insertKey=sprintf("INSERT INTO document_has_keyword(id_keyword,id_document) VALUES(%s,%s)",
									GetSQLValueString($id_keyword, "int"),
									GetSQLValueString($id_doc, "int"));
				$ResultKey=mysql_query($insertKey,$pravo);
				if(!$ResultKey)
					$success=false;
				
		
			}
	  if($Result1){
				//echo "<div style='margin-top:-20px; color:#66CC00;'>";
				_show_message_color('Документот е успешно изменет!','GREEN'); 
				$success=true;
				$MM_redirectLoginSuccess="?".$_SERVER['QUERY_STRING'];
				echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
				echo "<script>'Content-type: application/octet-stream'</script>";
				//echo "</div>";
	  }
	 if ($success == true)
	  {
		  //echo "COMMIT";
		 $query = "COMMIT";
		 $result_query = @mysql_query($query, $pravo);
	  }else{
		  //echo "ROLLBACK";
		  $query = "ROLLBACK";
		  $result_query = @mysql_query($query, $pravo);
	  }
}

if ((isset($_GET['id'])) && ($_GET['id'] != "") && (isset($_GET['delete']))) {
		
		mysql_select_db($database_pravo, $pravo);
		 $query        = "SET AUTOCOMMIT=0";
         $result_query = @mysql_query($query, $pravo);
		 
		  $query        = "BEGIN";
         $result_query = @mysql_query($query, $pravo);

		//$id_doc_type=-1;
//		if((isset($_POST['id_doc_type']))){
//			$id_doc_type=$_POST['id_doc_type'];
//		}elseif((isset($_GET['id_doc_type']))){
//			$id_doc_type=$_GET['id_doc_type'];
//		}
		$success = true;
		$DocumentQuery=sprintf("SELECT * FROM document where id_document=%s",GetSQLValueString($_GET['id'],"int"));
		$Document = mysql_query($DocumentQuery,$pravo) or die(mysql_error());
		$id_doc_type = mysql_result($Document,0,'id_doc_type');
		$file = mysql_result($Document, 0, 'filename');
		
		$DocTypeQuery_old = sprintf("SELECT * FROM doc_type WHERE id_doc_type=%s", GetSQLValueString($id_doc_type,"int"));
		$DocType_old = mysql_query($DocTypeQuery_old, $pravo) or die(mysql_error());
		$directory_old = mysql_result($DocType_old,0,'directory');
		
		$DiscussionQuery=sprintf("SELECT * FROM discussion where id_document=%s",
								 GetSQLValueString($_GET['id'],"int"));
		$DiscussionResult = mysql_query($DiscussionQuery, $pravo) or die(mysql_error());
		 mysql_query("BEGIN", $pravo);
		 
		if(mysql_num_rows($DiscussionResult)){
			$id_discussion=mysql_result($DiscussionResult,0,'id_discussion');
			
			$PostDelete = sprintf("DELETE FROM post WHERE id_discussion = %s",
								  GetSQLValueString($id_discussion,"int"));
			$PostResult = mysql_query($PostDelete,$pravo) or die(mysql_error());
		}
  
      	$deleteDiscussion = sprintf("DELETE FROM discussion WHERE id_document=%s",
                       GetSQLValueString($_GET['id'], "int"));
	   $Result1 = mysql_query($deleteDiscussion, $pravo) or die(mysql_error());
   
	   $deleteSQL = sprintf("DELETE FROM `document` WHERE id_document=%s",
                       GetSQLValueString($_GET['id'], "int"));
	
  	   $Result1 = mysql_query($deleteSQL, $pravo) or die(mysql_error());
  
 // $delete2SQL = sprintf("DELETE FROM `doc_meta` WHERE id_doc_meta=%s",
   //                    GetSQLValueString($_GET['id_doc_meta'], "int"));
//			 $Result2 = mysql_query($delete2SQL, $pravo) or die(mysql_error());
			 
 	$deleteIDDocument=sprintf("DELETE FROM document_has_keyword WHERE id_document=%s",GetSQLValueString($_GET['id'], "int"));
	$ResultIDDocument1=mysql_query($deleteIDDocument,$pravo);
  if($Result1){
				_show_message_color('Документот е успешно избришан!','GREEN');  
				$file_to_unlink = "../download/".$directory_old."/".$file;
		
		if(file_exists($file_to_unlink)){
			unlink($file_to_unlink);
			$message = "Документот ".$file_to_unlink." e избришан!";
			_show_message_color($message,'YELLOW');  	
		}
				unset($_GET['id']);
				unset($_GET['delete']);
  }else{
	  $success=false;
  }
  
  if ($success == true)
  {
	 $query = "COMMIT";
     $result_query = @mysql_query($query, $pravo);
  }else{
	  $query = "ROLLBACK";
      $result_query = @mysql_query($query, $pravo);
  }

}



?>
<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />

<?php /*?><script type="text/javascript" src="../javaScripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",


		theme_advanced_buttons1 : "mymenubutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,emotions,undo,redo,link,unlink",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",

		
		
	});
	
</script><?php */?>

<?php if((isset($_GET['change']) && ($_GET['change']=="true")) || (!(isset($_GET['edit'])) && ($_GET['edit']="true"))) { ?>
<form method="post" name="form1" target="upload_iframe" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
<table width="100%" align="center">
<tr>
    <td width="29%" align="right" valign="top">Избери документ:</td>
    <td width="71%">
    <input type="hidden" name="fileframe" value="true">
    <input type="file" name="file" id="file" onChange="jsUpload(this)">
          <br />
    <input type="text" name="upload_status" id="upload_status" 
           value="Документот не е закачен" size="50" disabled>
      </td>
  </tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
/* This function is called when user selects file in file dialog */
function jsUpload(upload_field)
{
    // this is just an example of checking file extensions
    // if you do not need extension checking, remove 
    // everything down to line
    // upload_field.form.submit();

    var re_text = /\.gif|\.jpg|\.swf|\.pdf|\.doc|\.txt|\.png/i;
    var filename = upload_field.value;

    /* Checking file type */
    if (filename.search(re_text) == -1)
    {
        alert("File does not have text(gif, jpg, swf, png, pdf) extension");
        upload_field.form.reset();
        return false;
    }

    upload_field.form.submit();
	document.getElementById('upload_status').style.backgroundColor = "#EEFFEE";
	document.getElementById('upload_status').style.borderColor = "#00FF00";
    document.getElementById('upload_status').value = "uploading file...";
    upload_field.disabled = true;
    return true;
}
</script>
<iframe name="upload_iframe" style="width: 400px; height: 100px; display: none">
</iframe>
<!-- For debugging purposes, it's often useful to remove
     "display: none" from style="" attribute -->
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">

<!-- Target of the form is set to hidden iframe -->
<!-- From will send its post data to fileframe section of 
     this PHP script (see above) -->
  <table width="100%" align="center">
    <tr valign="baseline">
      <td nowrap align="right">Име на документот:</td>
      <td><input type="text" name="title" id="title" value="<?php if(isset($_GET['id'])) echo htmlentities($row_Recordset1['title'], ENT_COMPAT, 'UTF-8');?>" size="53">
      <input name="filename" type="hidden" id="filename" value="<?php echo htmlentities($row_Recordset1['filename'], ENT_COMPAT, ''); ?>">
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Датум на објавување:</td>
      <td>       

        <input type="text" size="20" name="published_date"  value="<?php if($row_Recordset1['published_date']!=NULL) echo date("d.m.Y", strtotime(htmlentities($row_Recordset1['published_date'], ENT_COMPAT, ''))); ?>" id="jQueryUICalendar1"/>
        <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar1
//jQuery("#jQueryUICalendar1").datepicker();
jQuery("#jQueryUICalendar1").datepicker({ dateFormat: 'dd.mm.yy',  altField: '#actualDate' });


// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar1
        </script>        
        </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Сл. весник:</td>
      <td>
        <input name="ordinal" type="text" id="ordinal" size="3" value="<?php if(isset($_GET['id'])) echo htmlentities($row_Recordset1['ordinal'], ENT_COMPAT, 'UTF-8');?>" />
      <input type="hidden" name="id_doc_meta" value="<?php if(isset($_GET['id'])) echo htmlentities($row_Recordset1['id_doc_meta'], ENT_COMPAT, 'UTF-8');?>" />
      </td>
    </tr>
    <tr valign="baseline">
    	<td nowrap align="right" valign="top">Стапува во сила:</td>
        <td>
        	<input type="text" size="20" name="into_force_date"  value="<?php if($row_Recordset1['into_force_date']!=NULL) echo date("d.m.Y", strtotime(htmlentities($row_Recordset1['into_force_date'], ENT_COMPAT, ''))); ?>" id="jQueryUICalendar2"/>
        <script type="text/javascript">
// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar2
//jQuery("#jQueryUICalendar2").datepicker();
jQuery("#jQueryUICalendar2").datepicker({ dateFormat: 'dd.mm.yy',  altField: '#actualDate' });


// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar2
        </script>        
        </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Забелешка:</td>
      <td><textarea name="description" cols="40" rows="5"><?php echo htmlentities($row_Recordset1['description'], ENT_COMPAT, 'UTF-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Клучни зборови: <br />(Разделени со запирка)</td>
      <td><textarea name="keywords" cols="40" rows="5"><?php $i=0; do { $i++; ?><?php if(isset($_GET['id']) && !isset($_GET['delete'])) echo $row_RecordsetKeyword['val'];if($i<$totalRows_RecordsetKeyword) echo ", "; ?><?php } while ($row_RecordsetKeyword = mysql_fetch_assoc($RecordsetKeyword)); ?></textarea></td>
    </tr>
    <tr valign="baseline">
    	<td nowrap="nowrap" align="right">Индекс:</td>
        <td>
        <?php $cyr_alphabet = cyr_alphabet(); ?>
        <select name="idx">
        	<option<?php if (!isset($row_Recordset1['idx']) || $row_Recordset1['idx'] == '') echo ' selected="selected"'; ?>></option>
            <?php for ($i=0;$i<count($cyr_alphabet);$i++) { ?>
            	<option value=<?php echo $cyr_alphabet[$i]; if (isset($row_Recordset1['idx']) && $row_Recordset1['idx'] == $cyr_alphabet[$i]) echo ' selected="selected"'; ?>><?php echo $cyr_alphabet[$i]; ?></option>
            <?php } ?>
         </select>
         </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Тип на документот:</td>
      <td><select name="id_doc_type">
        <?php 
do {  
?>
        <option value="<?php echo $row_DocumentTypes['id_doc_type']?>" <?php if (!(strcmp($row_DocumentTypes['id_doc_type'], htmlentities($row_Recordset1['id_doc_type'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_DocumentTypes['name']?></option>
        <?php
} while ($row_DocumentTypes = mysql_fetch_assoc($DocumentTypes));
?>
      </select>
      <a href="document_type.php?mode=new&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/add.gif" border="0" /></a>
      <a href="document_type.php?id=<?php echo $row_Recordset1['id_doc_type']; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a>
      </td>
    </tr>
    <form name=sel>
  	<tr>
        <td align='right'>Категорија: </td>
        <td>

            <font id=category><select style='width:300px;'>
            <option value='0'>Категорија</option> 
            </select></font>
            <a href="document_category.php?mode=new&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/add.gif" border="0" /></a>
      <a href="document_category.php?id=<?php echo $cat; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a>
      	
        </td>
  	</tr>
	<tr>
        <td align='right'>Подкатегорија: </td>
        <td>
            <font id=subcategory><select style='width:300px;' disabled>
            <option value='0'>Подкатегорија</option> 
            </select></font>
            <a href="document_category.php?mode=new&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/add.gif" border="0" /></a>
      <a href="document_category.php?id=<?php echo $subcat; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a>
        </td>
  	</tr>
    <tr>
         <td align='right'>Под-подкатегорија: </td>
         <td>
            <font id=subsubcategory><select style='width:300px;' disabled>
            <option value='0'>Под-подкатегорија</option>
            </select></font>
      <a href="document_category.php?mode=new&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/add.gif" border="0" /></a>
      <a href="document_category.php?id=<?php echo $subsubcat; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a>
      </td>
	</tr>
    </form>
    <?php if(isset($_GET['id']) && isset($_GET['edit'])) { ?>
    <tr valign="baseline">
      <td rowspan="2" align="right" valign="top" nowrap>Документ:</td>
      <td><a href="../download.php?id=<?php echo $row_Recordset1['id_document']; ?> "><img src="../images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a>&nbsp;&nbsp;<a href="<?php echo "?".$_SERVER['QUERY_STRING']."&change=true" ?>">замени</a></td>
   </tr>
    <tr valign="baseline">
      <td>
      </td>
    </tr>
     <?php } ?>
    <tr valign="baseline">
      <td nowrap align="right">Форсирај претплата:</td>
      <td>
      <input type="checkbox" name="forcesubscribe" value=""  <?php if (!(strcmp(htmlentities($row_Recordset1['forcesubscribe'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>
      <?php if(isset($_GET['id'])){ ?>
      <input type="submit" name="MM_update" value="Измени" >
      <?php }else{ ?>
      <input type="submit" id="upload_button" value="Зачувај" disabled>	
      <input type="hidden" name="MM_insert" value="form1" />
      <?php } ?>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id_document" value="<?php echo $row_Recordset1['id_document']; ?>">
</form>

<script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val,sel) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //ÃÑº¤èÒ¡ÅÑºÁÒ
               } 
          }
     };
     req.open("GET", "util/categoryAjax.php?data="+src+"&val="+val+"&sel="+sel); //ÊÃéÒ§ connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8"); // set Header
     req.send(null); //Êè§¤èÒ
}


	window.onload=dochange('category',-1,<?php echo $cat; ?> );
	window.onload=dochange('subcategory',<?php echo $cat; ?>,<?php echo $subcat; ?>);
	window.onload=dochange('subsubcategory',<?php echo $subcat; ?>,<?php echo $subsubcat; ?>);

</script>

<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);

mysql_free_result($DocumentGroups);

mysql_free_result($DocumentTypes);
?>