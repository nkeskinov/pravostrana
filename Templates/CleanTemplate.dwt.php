<?php 
session_start();
?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="../style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../images/favicon1.png" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>pravo.org.mk</title>
<!-- TemplateEndEditable -->
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>

<script type="text/javascript" src="../roktools.js"></script>

<script type="text/javascript" src="../mootools.js"></script>

<script type="text/javascript" src="../javaScripts/cirillic_converter.js"></script>
<script type="text/javascript" src="../rokmoomenu.js"></script>
<script language="javascript" type="text/javascript" src="../javaScripts/prototype.js"></script><script language="javascript" type="text/javascript" src="../javaScripts/autoExpandContract.js"></script>
 <script type="text/javascript">  
         // <![CDATA[  
         document.observe('dom:loaded', function() {  
             $$('.highlight').each(function(item) {  
                 item.observe('focus', function(){   
                     item.style.backgroundColor = "FDFFDE";  
                 });  
                 item.observe('blur', function(){   
                     item.style.backgroundColor = "ffffff";  
                 });               
             });  
             
         });  
         //   
         </script> 
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script type="text/javascript">

window.addEvent('domready', function() {

new rokmoomenu($E('ul.nav'), {

bgiframe: false,

delay: 500,

animate: {

props: ['opacity', 'width', 'height'],

opts: {

duration:400,

fps: 100,

transition: Fx.Transitions.sineOut

}

}

});

});

</script>

<style type="text/css">
<!--

-->
</style>
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="logoText"><img src="../images/banner.png" /></div>
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- TemplateBeginEditable name="Menu" -->
        <ul class="nav">
          <li class="active"><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="analysis.php">Анализи</a></li>
          <li><a href="policies.php">Прописи</a></li>
          <li><a href="#">Судска Пракса</a>
           <ul>
            <li><a href="courtpractice.php">Судска Пракса</a></li>
            <li><a href="europeancourt.php">Европски суд</a></li>
           </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
      <!-- TemplateEndEditable -->
        <div id="menu"></div>
        <div id="mapMenu">
       <!-- TemplateBeginEditable name="SiteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp; &raquo;&nbsp;&nbsp;</td><td><a href="documentlaws.php">Закони</a>&nbsp; &raquo;&nbsp;</td><td> Детален опис на законот</td></tr></table><!-- TemplateEndEditable -->
       </div>
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content">
            <div><img src="../images/726-90.jpg" width="728" height="90" /></div>
            <!-- TemplateBeginEditable name="Content" -->
            <table width="100%">
              <tr>
                <td width="28%" valign="top"><div class="left-block">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Наслов</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <p>Текст </p>
                  </div>
                </div></td>
                <td width="72%" valign="top"><div class="right-block-bigger">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Наслов</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <p>Текст </p>
                  </div>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td></td>
              </tr>
              <tr>
                <td valign="top"></td>
                <td valign="top"></td>
              </tr>
            </table>
            <!-- TemplateEndEditable -->
        <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

      </div>

 
        <div class="right">
        <?php include("util/login_block.php"); ?>
          <div style="width:250px; margin-top:5px; margin-bottom:5px;"><!-- TemplateBeginEditable name="SearchRegion" -->SearchRegion<!-- TemplateEndEditable --></div>
         &nbsp;
          <div><img src="../images/250-250.jpg" width="250" height="250" />
          </div>
          </div>

    </div>
    
	<div class="footer">Copyright &copy; 2008 Сите права задржани</div>	
</div>

</body>
</html>