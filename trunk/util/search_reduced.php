<?php require_once('Connections/pravo.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = "SELECT * FROM doc_group";
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<script language="JavaScript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
  if(popUpWin)
  {
    if(!popUpWin.closed) popUpWin.close();
  }
  var wint=0;
  var winl=0;
  if(screen.width){
	  winl=(screen.width-width)/2;
	  wint=(screen.height-height)/2;
  }
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  
  popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=yes,width='+width+',height='+height+',left='+winl+', top='+wint+',screenX='+winl+',screenY='+wint+'');
}


</script>


<div class="left-block">
	
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text">Пребарување</div></div>
                    <div class="right"></div>
  </div>
  <div class="sodrzina" style="background:#fbf7e0;">
    <form action="<?php echo $page; ?>" method="get">
                    <table width="240" border="0" cellpadding="1" cellspacing="0" >
                    <tr>
                        <td colspan="2" align="left"><div align="right" style="font-size:11px;"><a href="JavaScript:popUpWindow('help.php?id=1','','',450,'330');">совети за пребарување</a></div></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="55%" align="left">Име на законот: </td>
                       </tr>
                       <tr>
                        <td><input name="name" type="text" size="33" id="idname" onkeyup="this.form.name.value=toCyr(this.form.name.value)"></td>
                      </tr>
                      <tr>
                        <td align="left">Број&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  / &nbsp;Година: </td>
                      </tr>
                      <tr>
                        <td width="55%"><label>
                          <input name="number" type="text" id="number" size="2">
                          /
                          <input name="year" type="text" id="year" size="2">
                        </label></td>
                      </tr>
                      <tr>
                        <td align="left">Клучен збор: </td>
                      </tr>
                      <tr>
                        <td><label>
                          <input name="keyword" type="text" id="keyword" onkeyup="this.form.keyword.value=toCyr(this.form.keyword.value)" size="33">
                        </label></td>
                      </tr>
                      <tr>
                        <td><label>
                          <input type="submit" name="button" id="button" value="Барај">
                        </label></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                      </tr>
                    </table>
    </form>
				</div>
</div>
<p>&nbsp;</p>
<script type="text/javascript">
// BeginWebWidget YUI_Tooltip: contextid1

  (function() { 
    var cn = document.body.className.toString();
    if (cn.indexOf('yui-skin-sam') == -1) {
      document.body.className += " yui-skin-sam";
    }
  })();
  
  var yuitooltip1 = new YAHOO.widget.Tooltip("yuitooltip1",
                                            {
                                              context:"idname", 
                                              text:"Име на законот." 
                                            });
   var yuitooltip2 = new YAHOO.widget.Tooltip("yuitooltip2",
                                            {
                                              context:"number", 
                                              text:"Број на службен весник" 
                                            });
	 var yuitooltip3 = new YAHOO.widget.Tooltip("yuitooltip3",
                                            {
                                              context:"year", 
                                              text:"Година на службен весник" 
                                            });
	  var yuitooltip4 = new YAHOO.widget.Tooltip("yuitooltip4",
                                            {
                                              context:"keyword", 
                                              text:"Клучен збор" 
                                            });

// EndWebWidget YUI_Tooltip: contextid1
  </script>
