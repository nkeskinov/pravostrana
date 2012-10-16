<?php 
if (!isset($_SESSION)) {
	session_start();
}  
?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php //include("util/newsletter.php"); ?>
<?php 
$ip_address=$_SERVER['REMOTE_ADDR'];
$page=substr(strrchr($_SERVER['PHP_SELF'],"/"),1);
$from_page="";
$referrer = "";
if (isset($_SERVER['HTTP_REFERER'])) {
	$from_page=substr(strrchr($_SERVER['HTTP_REFERER'],"/"),1);
	$referrer=$_SERVER['HTTP_REFERER'];
}
$browser=$_SERVER['HTTP_USER_AGENT'];
$language=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
$id_user=1;
if (isset($_SESSION['MM_ID']))
	$id_user=$_SESSION['MM_ID'];
if (isset($_GET['id'])) {
	$id_document = GetSQLValueString($_GET['id'], "int");
} else {
	header('Location: index.php');
}
mysql_select_db($database_pravo, $pravo);

//document details
$query_DetailRS1 = sprintf("select document_detail.*, doc_meta.ordinal, doc_meta.`date` FROM (SELECT document.title, document.description, doc_type.name as doc_type_title, document.id_document, document.id_superdoc, document.id_doc_group, document.id_doc_type,  document.id_doc_meta, document.into_force, document.published_date, document.uploaded_date, document.into_force_date, document.mimetype, document.no_downloads, page.path FROM document, doc_type, page WHERE document.id_document = %s AND doc_type.id_doc_type = document.id_doc_type AND doc_type.id_page = page.id_page) document_detail LEFT JOIN doc_meta ON document_detail.id_doc_meta = doc_meta.id_doc_meta", GetSQLValueString($id_document, "-1"));
$DetailRS1 = mysql_query($query_DetailRS1, $pravo) or die(mysql_error());
if (mysql_num_rows($DetailRS1) != 1) {
	header('Location: index.php');
}
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if ($row_DetailRS1['id_superdoc'] != NULL) {
	header('Location: documentDetail.php?id='.$row_DetailRS1['id_superdoc']);
}
$id_group = $row_DetailRS1['id_doc_group'];
$id_type = $row_DetailRS1['id_doc_type'];
$id_meta = $row_DetailRS1['id_doc_meta'];
$page = $row_DetailRS1['path'];
$document_title = $row_DetailRS1['title'];
if (mb_strlen($document_title, "UTF-8") > 70) {
	$document_title_words = explode(' ', $document_title);
	$document_title_short = '';
	$counter = 0;
	$i = 0;
	while ($counter <= 70) {
		$document_title_short = sprintf('%s %s', $document_title_short, $document_title_words[$i]);
		$counter += mb_strlen($document_title_words[$i++], "UTF-8") + 1;
	}
	if (!preg_match('/^\p{L}+$/u', mb_substr($document_title_short, $counter - 1, $counter, "UTF-8"))) {
		$document_title_short = mb_substr($document_title_short, 0, $counter - 1, "UTF-8");
	}
	$document_title_short = sprintf('%s...', $document_title_short);
} else {
	$document_title_short = $document_title;
}
$document_description = $row_DetailRS1['description'];
$document_type = $row_DetailRS1['doc_type_title'];
$published_date = $row_DetailRS1['published_date'];
$uploaded_date = $row_DetailRS1['uploaded_date'];
$into_force_date = $row_DetailRS1['into_force_date'];
$rs_into_force = $row_DetailRS1['into_force'];
$mime_type = $row_DetailRS1['mimetype'];
$no_downloads = $row_DetailRS1['no_downloads'];
$meta_ordinal = $row_DetailRS1['ordinal'];
$meta_date = $row_DetailRS1['date'];

mysql_free_result($DetailRS1);

//Selecting the subsubgroup, subgroup and group for the document
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
						",GetSQLValueString($id_group,"int"),GetSQLValueString($id_group,"int"),GetSQLValueString($id_group,"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
$numRows_DocGroup = mysql_num_rows($DocGroup);
$docGroups = array();
for ($i = 0; $i < $numRows_DocGroup; $i++) {
	$row_DocGroup = mysql_fetch_assoc($DocGroup);
	$docGroups[$i] = array('id_doc_group' => $row_DocGroup['id_doc_group'], 'name' => $row_DocGroup['name']);
}
mysql_free_result($DocGroup);
//print_r($row_DocGroup);

//keywords
$query_RecordsetKeyword = sprintf("SELECT k.val FROM keyword k, document_has_keyword dk, document d WHERE dk.id_keyword=k.id_keyword AND dk.id_document=d.id_document AND d.id_document=%s", GetSQLValueString($id_document, "int"));
$RecordsetKeyword = mysql_query($query_RecordsetKeyword, $pravo) or die(mysql_error());

$keywords = array();
$keywords_size = 0;
while($row_RecordsetKeyword = mysql_fetch_assoc($RecordsetKeyword)) {
	$keywords[$keywords_size++] = $row_RecordsetKeyword['val'];
}

mysql_free_result($RecordsetKeyword);

trackVisit($ip_address, $referrer, $browser, $language, $id_user, $page, $from_page, $database_pravo, $pravo);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CleanTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<!-- InstanceBeginEditable name="meta_description" -->
<meta name="description" content="<?php echo $document_title; ?>" />
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="keywords" -->
<meta name="keywords" content="<?php echo $document_title.','.implode($keywords, ','); ?>" />
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | <?php echo $document_title; ?></title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="scripts" -->
<?php require("util/banner.php"); ?>
<!-- InstanceEndEditable -->
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>
<script type="text/javascript" src="mootools.js"></script>
<script type="text/javascript" src="rokmoomenu.js"></script>
<script type="text/javascript" src="javaScripts/cirillic_converter.js"></script>
<script type="text/javascript" src="javaScripts/popUpWindow.js"></script>
<script language="javascript" type="text/javascript" src="javaScripts/MM.js"></script>
<script type="text/javascript">
<!--
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
//-->
</script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<table align="center"><tr><td>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>    
   	  </div>
      <div id="horiz-menu" ><!-- InstanceBeginEditable name="Menu" -->
        <ul class="nav">
          <li><a href="index.php">Почетна</a></li>
          <li <?php if($page=="documentlaws.php") echo 'class="active"' ?>><a href="documentlaws.php">Закони</a></li>
          <li <?php if($page=="analysis.php") echo 'class="active"' ?>><a href="analysis.php">Анализи</a></li>
          <li <?php if($page=="regulations.php") echo 'class="active"' ?>><a href="regulations.php">Прописи</a></li>
          <li <?php if($page=="courtpractice.php" || $page=="europeancourt.php") echo 'class="active"' ?>><a href="courtpractice.php">Судска пракса</a>
          	<ul>
            	 <li><a href="courtpractice.php">Судска пракса</a></li>
            	 <li><a href="europeancourt.php">Европски суд за човекови права</a></li>
             </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
        <div id="mapMenu">
       <!-- InstanceBeginEditable name="SiteMap" -->
       <table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</td><td>
	   <?php if($page=="documentlaws.php") echo '<a href="documentlaws.php">Закони</a>'; if($page=="analysis.php") echo '<a href="analysis.php">Анализи</a>';  if($page=="regulations.php") echo '<a href="regulations.php">Прописи</a>'; if($page=="courtpractice.php") echo '<a href="courtpractice.php">Судска пракса</a>';  if($page=="europeancourt.php") echo '<a href="europeancourt.php">Судска пракса на Европски суд</a>';?>
       &nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td><td> <?php echo $document_title_short; ?></td></tr></table> 
      <!-- InstanceEndEditable -->
       </div>
      </div>
	</div>
    
    <div class="mainBody">
            <!-- InstanceBeginEditable name="Content" -->
            <table width="100%" cellpadding="0">
             <tr>
                <td colspan="2"><div><?php getBanner($database_pravo, $pravo, 1); ?></div></td>
                <td rowspan="4" valign="top">
                <?php include("util/login_block.php"); ?>
        			  <p><a href="http://www.adobe.com/go/EN_US-H-GET-READER" target="_blank"><img src="images/get_adobe_reader.png" border="0" /></a> </p>
                      <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 5); ?></div>
                </td>
              </tr>
              <tr>
                <td valign="top" style="width:200px; padding-right:5px;"><div class="left-block">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Поврзани документи</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina" style="padding-left:2px; padding-right: 2px;">
                    <div style="padding:0; padding-top:10px;"><?php include("util/documents_by_category.php"); ?></div>
                  </div>
                </div></td>
                <td valign="top" width="468" style="padding-right:1px;"><div class="right-block-bigger">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Детален опис на документ</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <?php include("util/documentdetail.php"); ?>
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
            <!-- InstanceEndEditable -->
    </div>
	<div class="footer"><span style="float:left;">&copy; 2010 Сите права задржани</span><span style="float:right;"><a href="JavaScript:popUpWindow('help.php?id=5','','',600,520);" style="color:#FFFFFF;">Услови за користење</a> | <a href="JavaScript:popUpWindow('help.php?id=6','','',600,350);" style="color:#FFFFFF;">Политика за приватност</a></span></div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите.<div style="float:right;"><a href="http://www.most.org.mk" target="_blank"><img src="images/most.jpg" border="0"/></a></div></div>
</div>
</td></tr></table>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.pravo.org.mk/piwik/" : "http://www.pravo.org.mk/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.setDocumentTitle("<?php $documentPiwikName = $document_type . ' / ';
for ($i = 0; $i < count($docGroups); $i++) {
	$documentPiwikName .= $docGroups[$i]['name'] . ' / ';
} 
$documentPiwikName .= $document_title;
echo $documentPiwikName; ?>");
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.pravo.org.mk/piwik/piwik.php?idsite=1" style="border:0" alt=""/></p></noscript>
<!-- End Piwik Tag -->
</body>
<!-- InstanceEnd --></html>