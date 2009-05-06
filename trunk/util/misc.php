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

?>