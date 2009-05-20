<?php
function _show_message_color($_message,$_color="")
	{
		$bgcolor_table = "";
		$bgcolor_td = "";
		switch ($_color) 
		{
			case "RED": $bgcolor_table = "#FF0000"; $bgcolor_td = "#FFEEEE"; $_image = "error.png"; break;
			case "YELLOW": $bgcolor_table = "#FFF000"; $bgcolor_td = "#FFFEEE"; break;
			case "GREEN": $bgcolor_table = "#00FF00"; $bgcolor_td = "#EEFFEE"; $_image = "accept.png"; break;
			case "BLACK": $bgcolor_table = "#000000"; $bgcolor_td = "#FFFFFF"; break;
			default: $bgcolor_table = "#000000"; $bgcolor_td = "#FFFFFF"; break;
		}
		?><table bgcolor="<?php echo $bgcolor_table?>" width="100%" cellspacing="1" align="center"><tr><td bgcolor="<?php echo $bgcolor_td?>" align="center" valign="middle" ><img src="images/<?php echo $_image?>" align="absmiddle"/>&nbsp;<?php echo $_message?></div></td></tr></table><?php 
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
		$headers .= "Content-Type: text/html; charset=iso-8859-1".$eol; 
		$headers .= "Content-Transfer-Encoding: 8bit".$eol; 	
	
		# SEND THE EMAIL 
		ini_set("sendmail_from",$_from_email);  // the INI lines are to force the From Address to be used ! 
		$res = mail($_to, $_subject, $_message, $headers); 
		ini_restore("sendmail_from");
		return $res;
	}

?>