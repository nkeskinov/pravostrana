<?php
if (!function_exists("isAuthorized")) {
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}
}
if (!function_exists("_show_message_color")) {
function _show_message_color($_message,$_color="")
	{
		$bgcolor_table = "";
		$bgcolor_td = "";
		switch ($_color) 
		{
			case "RED": $bgcolor_table = "#FF0000"; $bgcolor_td = "#FFEEEE"; $_image = "error.png"; break;
			case "YELLOW": $bgcolor_table = "#FFF000"; $bgcolor_td = "#FFFEEE"; $_image = "caution.png"; break;
			case "GREEN": $bgcolor_table = "#00FF00"; $bgcolor_td = "#EEFFEE"; $_image = "accept.png"; break;
			case "BLACK": $bgcolor_table = "#000000"; $bgcolor_td = "#FFFFFF"; break;
			default: $bgcolor_table = "#000000"; $bgcolor_td = "#FFFFFF"; $_image = "caution.png"; break;
		}
		//TODO: path dependant of user role
		?><table bgcolor="<?php echo $bgcolor_table?>" width="100%" cellspacing="1" align="center"><tr><td bgcolor="<?php echo $bgcolor_td?>" align="center" valign="middle" ><img src="images/<?php echo $_image?>" align="absmiddle"/>&nbsp;<?php echo $_message?></div></td></tr></table><?php 
	}
}
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
if (!function_exists("cyr2lat")) {
	function cyr2lat($input){
			$cyr=array(
    "а","б","в","г","д","ѓ","е","ж","з","ѕ","и","ј","к","л","љ","м","н","њ","о","п","р","с","т","ќ","у","ф","х","ц","ч","џ","ш");
    $lat=array(
    "a","b","v","g","d","gj","e","zh","z","dz","i","j","k","l","lj","m","n","nj","o","p","r","s","t","kj","u","f","h","c","ch","dz","sh");
	$input=mb_strtolower($input,"UTF-8");
		 for($i=0; $i < count($cyr); $i++){
		   $current_cyr= $cyr[$i];
		   $current_lat= $lat[$i];
		   $input=str_replace($current_cyr,$current_lat,$input);
		   $input=str_replace(strtolower($current_cyr),strtolower($current_lat),$input);
		 }
    	return($input);
    }
}
if (!function_exists("lat2cyr")) {
	function lat2cyr($input){
			$cyr=array(
    "а","б","в","г","д","ѓ","е","ж","з","ѕ","и","ј","к","л","љ","м","н","њ","о","п","р","с","т","ќ","у","ф","х","ц","ч","џ","ш","А","Б","В","Г","Д","Ѓ","Е","Ж","З","Ѕ","И","Ј","К","Л","Љ","М","Н","Њ","О","П","Р","С","Т","Ќ","У","Ф","Х","Ц","Ч","Џ","Ш");
    $lat=array(
    "a","b","v","g","d","gj","e","zh","z","dz","i","j","k","l","lj","m","n","nj","o","p","r","s","t","kj","u","f","h","c","ch","dz","sh","A","B","V","G","D","GJ","E","Zh","Z","Dz","I","J","K","L","Lj","M","N","Nj","O","P","R","S","T","Kj","U","F","H","C","Ch","Dz","Sh");
	//$input=mb_strtolower($input,"UTF-8");
	
     for($i=0;$i<count($lat);$i++){
       $current_cyr=$cyr[$i];
       $current_lat=$lat[$i];
       $input=str_replace($current_lat,$current_cyr,$input);
       $input=str_replace(strtolower($current_lat),strtolower($current_cyr),$input);
     }
    return($input);
    }
}
if (!function_exists("send_mail")) {
	function send_mail($_from_name,$_from_email,$_to,$_subject,$_message)
	{
		# Is the OS Windows or Mac or Linux 
		if (strtoupper(substr(PHP_OS,0,3)=='WIN')) { 
		  $eol="\r\n"; 
		} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) { 
		  $eol="\r"; 
		} else { 
		  $eol="\n"; 
		}
		
		# Common Headers 
		$headers = "From: $_from_name <$_from_email>".$eol; 
		# $headers .= 'Reply-To: $_from_name <$_from_email>'.$eol; 
		# $headers .= 'Return-Path: $_from_name <$_from_email>'.$eol; 
		$headers .= "X-Mailer: PHP v".phpversion().$eol;          // These two to help avoid spam-filters 
		
		# Boundry for marking the split & Multitype Headers 
		$headers .= 'MIME-Version: 1.0'.$eol; 
		$headers .= "Content-Type: text/html; charset=UTF-8".$eol; 
		$headers .= "Content-Transfer-Encoding: 8bit".$eol; 	
	
		# SEND THE EMAIL 
		ini_set("sendmail_from",$_from_email);  // the INI lines are to force the From Address to be used ! 
		$_subject = '=?UTF-8?B?'.base64_encode($_subject).'?=';
		$res = mail($_to, $_subject, $_message, $headers); 
		ini_restore("sendmail_from");
		return $res;
	}
}

if (!function_exists("trackVisit")) {
function trackVisit($ip_address, $referrer, $browser, $language, $id_user, $page, $from_page, $database_pravo, $pravo){
	mysql_select_db($database_pravo, $pravo);
	$success=false;
	
	$QueryPage=sprintf("SELECT * from page where path = %s",GetSQLValueString($page, "text"));
	$ResultPage = mysql_query($QueryPage, $pravo) or die(mysql_error());	
	$id_page=-1;
	if(mysql_num_rows($ResultPage)>0){
		$id_page=mysql_result($ResultPage,0,'id_page');	
	}
	
	$QueryFromPage=sprintf("SELECT * from page where path = %s",GetSQLValueString($from_page, "text"));
	$ResultFromPage = mysql_query($QueryFromPage, $pravo) or die(mysql_error());	
	$id_from_page=NULL;
	if(mysql_num_rows($ResultFromPage)>0){
		$id_from_page=mysql_result($ResultFromPage,0,'id_page');	
	}
	
	if(!(isset($_SESSION['id_visit']))){
		$now = date("Y-m-d H:i:s");
		$Query=sprintf("INSERT INTO visit(id_user, ip, referrer, browser, language, visited_date) 
						 VALUES(%s,%s,%s,%s,%s, %s)",
						GetSQLValueString($id_user, "int"),
						GetSQLValueString($ip_address, "text"),
						GetSQLValueString($referrer, "text"),
						GetSQLValueString($browser, "text"),
						GetSQLValueString($language, "text"),
						"'".$now."'");
		$Result = mysql_query($Query, $pravo) or die(mysql_error());	
		$_SESSION['id_visit']=mysql_insert_id();
		if($Result)
			$success=true;
		
	}
	if(isset($_SESSION['id_visit']) && isset($_SESSION['MM_ID'])){
		
		$UpdateQuery=sprintf("UPDATE visit SET id_user=%s WHERE id_visit=%s",	
							 GetSQLValueString($_SESSION['MM_ID'], "int"),
							 GetSQLValueString($_SESSION['id_visit'], "int"));
		
		$Result2 = mysql_query($UpdateQuery, $pravo) or die(mysql_error());	
	}
	//echo "Session:".$_SESSION['id_visit']."<br>";
	//echo "Page:".$id_page."<br>";
	//echo "From page:".$id_from_page."<br>";
	$Query1=sprintf("INSERT INTO page_visit(id_visit, id_page, id_from_page) VALUES(%s,%s,%s)",GetSQLValueString($_SESSION['id_visit'], "int"),GetSQLValueString($id_page, "int"), GetSQLValueString($id_from_page, "int"));
	$ResultPageVisit = mysql_query($Query1, $pravo) or die(mysql_error());
	if($ResultPageVisit)
		$success=true;
}
}
?>