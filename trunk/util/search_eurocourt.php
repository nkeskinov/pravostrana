<form action="europeancourt.php" method="get" enctype="application/x-www-form-urlencoded">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" >
  <tr>
  	<td></td>
    <td width="17%">&nbsp;</td>
    <td width="83%" align="right">
      <a href="JavaScript:popUpWindow('help.php?id=4','','',450,280);" class="search_advices">совети за пребарување</a>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Име:</td>
    <td>
      <input name="name" type="text" id="name" size="60" />
      </td>
     <td align="right">
      <a href="euLawTutorial.php" ><u>Правна рамка на <br />Европската Унија</u></a></div></td>
    </td>
  </tr>
  <tr>
        <td align='left'>Категорија: </td>
        <td colspan="2">
            <form name=sel>
            <font id="category1"><select style='width:320px;'>
            <option value='0'>Изберете категорија</option> 
            </select></font>
        </td>
  	</tr>
	<tr>
        <td align='left'>Подкатегорија: </td>
        <td colspan="2">
            <font id="subcategory1"><select style='width:320px;' disabled>
            <option value='0'>Изберете подкатегорија</option> 
            </select></font>
        </td>
  	</tr>
  <tr>
    <td>Година:</td>
    <td colspan="2"><input name="year1" type="text" size="3" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">
      <input type="submit" name="button" id="button" value="Барај">
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><a href="http://www.pravda.gov.mk/tekstovi.asp?lang=mak&id=covprav">Пресуди и одлуки на Европскиот суд за човекови права во кои како тужена страна се јавува Република Македонија</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>

<script language=Javascript>


function dochange1(src, val) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //ÃÑº¤èÒ¡ÅÑºÁÒ
               } 
          }
     };
     req.open("GET", "util/europeanCategoryAjax.php?data="+src+"&val="+val+"&type=5"); //ÊÃéÒ§ connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
     req.send(null); //Êè§¤èÒ
}

window.onLoad=dochange1('category1', -1);     
</script>