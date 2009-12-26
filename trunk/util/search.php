<?php require_once('Connections/pravo.php'); ?>
<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


/*mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = "SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND id_supergroup is NULL ORDER BY dg.id_doc_group ASC";
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
*/

$query_Documents = sprintf("SELECT count(*) total, min(published_date) from_date, max(published_date) to_date
							FROM document
							WHERE document.id_doc_type =1
							AND document.id_superdoc IS NULL ");
$all_Documents = mysql_query($query_Documents);
if(mysql_num_rows($all_Documents)>0){
	$total=mysql_result($all_Documents,0,'total');
	$from_date=date("Y",strtotime(mysql_result($all_Documents,0,'from_date')));
	$to_date=date("Y",strtotime(mysql_result($all_Documents,0,'to_date')));
}

$query_Index = sprintf("SELECT DISTINCT idx
							FROM document
							WHERE document.id_doc_type =1
							AND document.id_superdoc IS NULL ORDER BY idx ASC ");
$Index = mysql_query($query_Index);

$row_Index = mysql_fetch_assoc($Index);
$index_array=array();
do{
	array_push($index_array,$row_Index['idx']);
}while($row_Index=mysql_fetch_assoc($Index));

//print_r($index_array);

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

<div style="height:300px;">
<form action="documentlaws.php" method="get" enctype="application/x-www-form-urlencoded" >
<table width="95%" border="0">
<tr>
    <td colspan="2" align="left"><div align="right"><a href="JavaScript:popUpWindow('help.php?id=1','','',450,'330');" class="search_advices">совети за пребарување</a></div>
    <strong>Пребарувај по почетна буква на законот</strong>
    </td>
  </tr>
<tr>
    <td colspan="2" align="left"><div class="letters">
    <?php 
	$cyr_alphabet = cyr_alphabet();
	for ($i=0;$i<count($cyr_alphabet);$i++) {
		if(in_array($cyr_alphabet[$i], $index_array)) {
			echo '<a href="documentlaws.php?starts_with='.urlencode($cyr_alphabet[$i]).'">'.$cyr_alphabet[$i].'</a>';
		} else {
			echo '<span style="color:#ccc">'.$cyr_alphabet[$i].'</span>';
		}
		if ($i < count($cyr_alphabet) - 1) {
			echo '&nbsp;';
		}
	}
	?>
    </div></td>
  </tr>
  <tr>
    <td width="46%">&nbsp;</td>
    <td width="54%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">Име на законот: </td>
    <td><input name="name" id="name" type="text" size="35" onkeyup="this.form.name.value=toCyr(this.form.name.value)"></td>
  </tr>
   <tr>
    <td align="left">Број / Година: </td>
    <td>
      <input name="number" type="text" id="number" size="4">
      /
      <input name="year" type="text" id="year" size="4">
    </td>
  </tr>
 	<tr>
        <td align="left" valign="top" style="padding-top:7px;">Категорија: </td>
        <td>
            
            <div style="padding:2px; padding-left:0;">
            	<font id="category"><select style='width:320px;' name="category">
	            <option value='0'>Изберете категорија</option> 
    	        </select></font></div>
        	    <div style="padding:2px; padding-left:0;"><font id="subcategory"></font></div>
            	<div style="padding:2px; padding-left:0;"><font id="subsubcategory"></font></div>
            
        </td>
  	</tr>
	<tr>
    <td align="left">Клучен збор: </td>
    <td><label>
      <input name="keyword" type="text" id="keyword" onkeyup="this.form.keyword.value=toCyr(this.form.keyword.value)" size="47">
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><label>
      <input type="submit" name="button" id="button" value="Барај">
    </label></td>
  </tr>
  <tr>
    <td colspan="2" align="left">Базата содржи вкупно <strong><?php echo $total; ?></strong> закони донесени во периодот од <strong>1992</strong> до <strong><?php echo $to_date; ?></strong> година. </td>
   </tr>
   </table>
</form>
</div>
<script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //ÃÑº¤èÒ¡ÅÑºÁÒ
               } 
          }
     };
     req.open("GET", "util/categoryAjax.php?data="+src+"&val="+val); //ÊÃéÒ§ connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8"); // set Header
     req.send(null); //Êè§¤èÒ
}

window.onLoad=dochange('category', -1);     
</script>

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
                                              context:"name", 
                                              text:"Името или дел од името на законот" 
                                            });
  var yuitooltip1 = new YAHOO.widget.Tooltip("yuitooltip2",
                                            {
											  context:"group", 
                                              text:"Категорија на која припаѓа законот" 
                                            });
   var yuitooltip1 = new YAHOO.widget.Tooltip("yuitooltip3",
                                            {
											  context:"number", 
                                              text:"Број на службен весник" 
                                            });
   var yuitooltip1 = new YAHOO.widget.Tooltip("yuitooltip4",
                                            {
											  context:"year", 
                                              text:"Година на службен весник" 
                                            });

  var yuitooltip1 = new YAHOO.widget.Tooltip("yuitooltip5",
                                            {
											  context:"keyword", 
                                              text:"Клучен збор" 
                                            });

// EndWebWidget YUI_Tooltip: contextid1
</script>
