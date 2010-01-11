<?php
require_once("../Connections/pravo.php");
include("misc.php");
mysql_select_db($database_pravo, $pravo);

function getDocumentCategory($id_document_group, $pravo, $database_pravo){
	
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
						",GetSQLValueString($id_document_group,"int"),GetSQLValueString($id_document_group,"int"),GetSQLValueString($id_document_group,"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
$row_DocGroup = mysql_fetch_assoc($DocGroup);
$row_number =  mysql_num_rows($DocGroup);
$category="";
if($row_number){
	$i=0;
	do{ 
		$category.= "<a href='http://pravo.org.mk/documentlaws.php?id_doc_group=".$row_DocGroup['id_doc_group']."'>".$row_DocGroup['name']."</a> "; 
		if($i<$row_number-1){
			$category.= "&raquo;&nbsp;";
		}
	$i++;
	}while ($row_DocGroup = mysql_fetch_assoc($DocGroup));
}
return $category;
}
$Query_document=sprintf("SELECT *
FROM document
LEFT JOIN doc_meta ON document.id_doc_meta = doc_meta.id_doc_meta
WHERE uploaded_date between date(subdate(now(), INTERVAL weekday(now()) DAY))
and date(adddate(now(), INTERVAL 6-weekday(now()) DAY))");
	$Result_AllDocuments=mysql_query($Query_document, $pravo) or die(mysql_error());
	$row_Documents = mysql_fetch_assoc($Result_AllDocuments);
	//print_r($row_Documents);
$page="documentlaws.php";	
$subject="Pravo.org.mk | Неделен извештај";
$body ="<html>
<head>
	<title>Неделен извештај</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv='Content-Language' content='mk-mk' />
	<style type='text/css'>
	<!--
	html {
		height: 100%;
		margin:0 auto;
		margin-bottom: 1px;
		font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;
	}
	body {
		margin: 0;
		padding: 0;
		background:none;
		background-repeat:repeat-x;
		background-color: #fdfdf6;
		font-size: 13px;
		line-height: 125%;
	}
	a:link {
		color: #333;
		text-decoration:none;
	}
	a:visited {
		color: #333;
		text-decoration:none;
	}
	a:hover {
		color: #999;
		text-decoration:none;
	
	}
	a:active {
		color: #333;
		text-decoration:none;
	}
	td.on {
		background: #fbf7e0;
	} 
	td.off {
		background:none;
	}
	tr.on {
		background: #fbf7e0;
	} 
	tr.off {
		background:none;
	}
	-->
	</style>
</head>
<body>
	<img src='http://pravo.org.mk/images/pravobanner1.png' />
	<p>Закони кои се закачени изминатата недела.</p>
	<table border='0' width='730' cellspacing='0'>";
do { 
$timestamp = strtotime($row_Documents['published_date']);
$SuperdocTitle="";
$id_superdoc_group=-1;
if($row_Documents['id_superdoc']!= ''){
	$query_latestLaw_superdoc = sprintf("SELECT id_document, title, id_doc_group FROM `document` WHERE id_document = %s" ,GetSQLValueString( $row_Documents['id_superdoc'], "int"));
	$latestLaw_superdoc = mysql_query($query_latestLaw_superdoc, $pravo) or die(mysql_error());	
	$SuperdocTitle=mysql_result($latestLaw_superdoc,0,'title');
	$id_superdoc_group=mysql_result($latestLaw_superdoc,0,'id_doc_group');
}
//echo "DRAGAN". $timestamp;
$body .="<tr>
	<td width='100%' style='border-bottom:1px solid #a25852; background:#fae9e8; padding-left:5px;'><strong><a href='http://pravo.org.mk/documentDetail.php?id=".$row_Documents['id_document']."&gid=".$row_Documents['id_doc_group']."&tid=".$row_Documents['id_doc_type']."&page=".$page."' title='Видете ги деталите за документот'><span style='font-variant:small-caps; font-weight:bolder; font-size:15px; '>".$row_Documents['title'].($row_Documents['id_superdoc'] != '' ? ' - ' . $SuperdocTitle : '')." ".((isset($row_Documents['into_force']) && !$row_Documents['into_force']) ? '<span style="color: red;"> - вон сила</span>' : "")."</span></a></strong><br> <span style='color:#666; font-size:11px'>&nbsp;".date($row_Documents['id_doc_type'] == 4 || $row_Documents['id_doc_type'] == 5 ? "Y" : "d.m.Y", $timestamp)."</span>";
if($row_Documents['id_doc_type'] == 1) {
$body.="|<span style='color:#666; font-size:11px'> Сл. весник/година:</span> <span style='font-size:11px; font-weight:bold;'>".$row_Documents["ordinal"]." </span>/<span style='font-size:11px; font-weight:bold;'> ".date("Y",strtotime($row_Documents["date"])); 
}elseif($row_Documents['id_doc_type'] == 4 || $row_Documents['id_doc_type'] == 5) { 
$body.="|<span style='color:#666; font-size:11px'> Суд:</span> <span style='font-size:11px;'>".$row_Documents["name"].' </span>'; 
}
$body.="</span></td>
<td width='5%' align='right' style='border-bottom:1px solid #a25852; background:#fae9e8;'><a href='http://pravo.org.mk/documentDetail.php?id=".$row_Documents['id_document']."&gid=".$row_Documents['id_doc_group']."&page=".$page."' title='Преземи го документот'>";
if($row_Documents['mimetype']=="application/msword"){ 
$body.="<img src='http://pravo.org.mk/images/word_icon_small3.png' alt='Преземи го документот' title='Преземи го документот' width='35' height='35' border='0' />";
}elseif($row_Documents['mimetype']=="text/plain"){ 
$body.="<img src='http://pravo.org.mk/images/text_icon_small3.png' alt='Преземи го документот' title='Преземи го документот' width='35' height='35' border='0' />";
}else{ 
$body.="<img src='http://pravo.org.mk/images/pdf_icon_small3.png' alt='Преземи го документот' title='Преземи го документот' width='35' height='35' border='0' />";
} 
$body.="</a></td>
</tr>
<tr>
	<td  style='border-bottom:1px solid #f5e6a2; background:#fbf7e0;' colspan='2'>категорија: ";
	$body.=getDocumentCategory(($row_Documents['id_superdoc'] != '' ? $id_superdoc_group : $row_Documents['id_doc_group']), $pravo, $database_pravo);
$body.="</td>
	</tr>
    <tr><td colspan='2'>&nbsp;</td></tr>";
} while ($row_Documents = mysql_fetch_assoc($Result_AllDocuments)); 
$body.="</table>
<span style='color:#666; font-size:11px'>Pravo.org.mk ја почитува вашата приватност. Pravo.org.mk никогаш не ја открил вашата email адреса на никој Pravo.org.mk корисник без ваша дозвола. <br /> © 2009, Pravo.org.mk Тимот.</span>
</body>
</html>";
echo $body;
send_mail("Pravo.org.mk","no-reply@pravo.org.mk","dragan.milcevski@gmail.com",$subject,$body);
?>