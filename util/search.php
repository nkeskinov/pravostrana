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
<table width="100%" border="0">
<tr>
    <td colspan="2" align="left"><div align="right" style="font-size:11px;"><a href="JavaScript:popUpWindow('help.php?id=1','','',450,'300');">совети за пребарување</a></div>
    <strong>Пребарувај по почетна буква на законот</strong>
    </td>
  </tr>
<tr>
    <td colspan="2" align="left"><div><a href="#">А</a> 
    <a href="#">Б</a> 
    <a href="#">В</a> 
    <a href="#">Г</a> 
    <a href="#">Д</a> 
    <a href="#">Ѓ</a> 
    <a href="#">Е</a> 
    <a href="#">Ж</a> 
    <a href="#">З</a> 
    <a href="#">Ѕ</a> 
    <a href="#">И</a> 
    <a href="#">Ј</a> 
    <a href="#">К</a> 
    <a href="#">Л</a> 
    <a href="#">Љ</a> 
    <a href="#">М</a> 
    <a href="#">Њ</a> 
    <a href="#">О</a> 
    <a href="#">П</a> 
    <a href="#">Р</a> 
    <a href="#">С</a> 
    <a href="#">Т</a> 
    <a href="#">Ќ</a> 
    <a href="#">У</a> 
    <a href="#">Ф</a> 
    <a href="#">Х</a> 
    <a href="#">Ц</a> 
    <a href="#">Џ</a> 
    <a href="#">Ш</a></div></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="76%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">Име на законот: </td>
    <td><input name="name" type="text" size="35"></td>
  </tr>
  <tr>
    <td align="left">Група: </td>
    <td><label>
      <select name="document_group" id="document_group">
      </select>
    </label></td>
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
    <td align="left">Клучен збор: </td>
    <td><label>
      <input name="keyword" type="text" id="keyword" size="50">
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><label>
      <input type="submit" name="button" id="button" value="Барај">
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
