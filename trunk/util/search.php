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


/*mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = "SELECT id_doc_group, dg.name name FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND id_supergroup is NULL";
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


<form action="documentlaws.php" method="get" enctype="application/x-www-form-urlencoded">
<table width="95%" border="0" height="250">
<tr>
    <td colspan="2" align="left"><div align="right" style="font-size:11px;"><a href="JavaScript:popUpWindow('help.php?id=1','','',450,'330');">совети за пребарување</a></div>
    <strong>Пребарувај по почетна буква на законот</strong>
    </td>
  </tr>
<tr>
    <td colspan="2" align="left"><div class="laters">
    <?php if(in_array("А",$index_array)) echo '<a href="documentlaws.php?starts_with=а">А</a>'; else echo "<span style='color:#ccc'>А</span>"; ?>
    <?php if(in_array("Б",$index_array)) echo '<a href="documentlaws.php?starts_with=б">Б</a>'; else echo "<span style='color:#ccc'>Б</span>"; ?>
    <?php if(in_array("В",$index_array)) echo '<a href="documentlaws.php?starts_with=в">В</a>'; else echo "<span style='color:#ccc'>В</span>"; ?>
    <?php if(in_array("Г",$index_array)) echo '<a href="documentlaws.php?starts_with=г">Г</a>'; else echo "<span style='color:#ccc'>Г</span>"; ?>
    <?php if(in_array("Д",$index_array)) echo '<a href="documentlaws.php?starts_with=д">Д</a>'; else echo "<span style='color:#ccc'>д</span>"; ?>
    <?php if(in_array("Ѓ",$index_array)) echo '<a href="documentlaws.php?starts_with=ѓ">Ѓ</a>'; else echo "<span style='color:#ccc'>Ѓ</span>"; ?>
    <?php if(in_array("Е",$index_array)) echo '<a href="documentlaws.php?starts_with=е">Е</a>'; else echo "<span style='color:#ccc'>Е</span>"; ?>
    <?php if(in_array("Ж",$index_array)) echo '<a href="documentlaws.php?starts_with=ж">Ж</a>'; else echo "<span style='color:#ccc'>ж</span>"; ?>
    <?php if(in_array("З",$index_array)) echo '<a href="documentlaws.php?starts_with=з">З</a>'; else echo "<span style='color:#ccc'>З</span>"; ?> 
    <?php if(in_array("Ѕ",$index_array)) echo '<a href="documentlaws.php?starts_with=ѕ">Ѕ</a>'; else echo "<span style='color:#ccc'>Ѕ</span>"; ?>
    <?php if(in_array("И",$index_array)) echo '<a href="documentlaws.php?starts_with=и">И</a>'; else echo "<span style='color:#ccc'>И</span>"; ?> 
    <?php if(in_array("Ј",$index_array)) echo '<a href="documentlaws.php?starts_with=ј">Ј</a>'; else echo "<span style='color:#ccc'>Ј</span>"; ?>
    <?php if(in_array("К",$index_array)) echo '<a href="documentlaws.php?starts_with=к">К</a>'; else echo "<span style='color:#ccc'>К</span>"; ?>
    <?php if(in_array("Л",$index_array)) echo '<a href="documentlaws.php?starts_with=л">Л</a>'; else echo "<span style='color:#ccc'>Л</span>"; ?>
    <?php if(in_array("Љ",$index_array)) echo '<a href="documentlaws.php?starts_with=љ">Љ</a>'; else echo "<span style='color:#ccc'>Љ</span>"; ?>
    <?php if(in_array("М",$index_array)) echo '<a href="documentlaws.php?starts_with=м">М</a>'; else echo "<span style='color:#ccc'>М</span>"; ?>
	<?php if(in_array("Н",$index_array)) echo '<a href="documentlaws.php?starts_with=н">Н</a>'; else echo "<span style='color:#ccc'>Н</span>"; ?>
    <?php if(in_array("Њ",$index_array)) echo '<a href="documentlaws.php?starts_with=њ">Њ</a>'; else echo "<span style='color:#ccc'>Њ</span>"; ?>
    <?php if(in_array("О",$index_array)) echo '<a href="documentlaws.php?starts_with=о">О</a>'; else echo "<span style='color:#ccc'>О</span>"; ?>
    <?php if(in_array("П",$index_array)) echo '<a href="documentlaws.php?starts_with=п">П</a>'; else echo "<span style='color:#ccc'>П</span>"; ?>
    <?php if(in_array("Р",$index_array)) echo '<a href="documentlaws.php?starts_with=р">Р</a>'; else echo "<span style='color:#ccc'>Р</span>"; ?>
    <?php if(in_array("С",$index_array)) echo '<a href="documentlaws.php?starts_with=с">С</a>'; else echo "<span style='color:#ccc'>С</span>"; ?>
    <?php if(in_array("Т",$index_array)) echo '<a href="documentlaws.php?starts_with=т">Т</a>'; else echo "<span style='color:#ccc'>Т</span>"; ?>
    <?php if(in_array("Ќ",$index_array)) echo '<a href="documentlaws.php?starts_with=ќ">Ќ</a>'; else echo "<span style='color:#ccc'>Ќ</span>"; ?>
   <?php if(in_array("У",$index_array)) echo '<a href="documentlaws.php?starts_with=у">У</a>'; else echo "<span style='color:#ccc'>У</span>"; ?>
    <?php if(in_array("Ф",$index_array)) echo '<a href="documentlaws.php?starts_with=ф">Ф</a>'; else echo "<span style='color:#ccc'>Ф</span>"; ?>
    <?php if(in_array("Х",$index_array)) echo '<a href="documentlaws.php?starts_with=х">Х</a>'; else echo "<span style='color:#ccc'>Х</span>"; ?>
    <?php if(in_array("Ц",$index_array)) echo '<a href="documentlaws.php?starts_with=ц">Ц</a>'; else echo "<span style='color:#ccc'>Ц</span>"; ?>
    <?php if(in_array("Џ",$index_array)) echo '<a href="documentlaws.php?starts_with=џ">Џ</a>'; else echo "<span style='color:#ccc'>Џ</span>"; ?>
    <?php if(in_array("Ш",$index_array)) echo '<a href="documentlaws.php?starts_with=ш">Ш</a>'; else echo "<span style='color:#ccc'>Ш</span>"; ?>
    </div></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="76%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">Име на законот: </td>
    <td><input name="name" id="name" type="text" size="35" onkeyup="this.form.name.value=toCyr(this.form.name.value)"></td>
  </tr>
   <tr>
    <td align="left">Број / Година: </td>
    <td><label>
      <input name="number" type="text" id="number" size="4">
      /
      <input name="year" type="text" id="year" size="4">
    </label></td>
  </tr>
 	<tr>
        <td align='left'>Категорија: </td>
        <td>
            <form name="sel">
            <font id="category"><select style='width:320px;' name="category">
            <option value='0'>Изберете категорија</option> 
            </select></font>
        </td>
  	</tr>
	<tr>
        <td align='left'>Подкатегорија: </td>
        <td>
            <font id="subcategory"><select style='width:320px;' disabled name="subcategory">
            <option value='0'>Изберете подкатегорија</option> 
            </select></font>
        </td>
  	</tr>
    <tr>
         <td align='left'>Под-податегорија: </td>
         <td>
            <font id="subsubcategory"><select style='width:320px;' disabled name="subsubcategory">
            <option value='0'>Изберете под-подакатегорија</option>
            </select></font>
		</td>
  	</tr>
  <tr>
    <td align="left">Клучен збор: </td>
    <td><label>
      <input name="keyword" type="text" id="keyword" onkeyup="this.form.keyword.value=toCyr(this.form.keyword.value)" size="50">
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
                                              text:"Име на законот" 
                                            });
  var yuitooltip1 = new YAHOO.widget.Tooltip("yuitooltip2",
                                            {
											  context:"group", 
                                              text:"Група на која припаѓа законот" 
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
