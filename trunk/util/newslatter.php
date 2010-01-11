<?php

function newslatterByDocument($id_document, $subject, $message1, $url, $pravo, $database_pravo){
	mysql_select_db($database_pravo, $pravo);
	
	$Query_document=sprintf("SELECT * FROM document 
							 WHERE id_document=%s",
						 	 GetSQLValueString($id_document, "int"));
	
	$Result_Document=mysql_query($Query_document, $pravo) or die(mysql_error());
	$document_title = mysql_result($Result_Document,0,'title');
	
	$Query_users=sprintf("SELECT * FROM user a, subscription_by_doc b 
						 WHERE a.id_user=b.id_user and b.id_document=%s",
						 GetSQLValueString($id_document, "int"));
	
	$Result_AllUsers=mysql_query($Query_users, $pravo) or die(mysql_error());
	$row_AllUsers = mysql_fetch_assoc($Result_AllUsers);
	do{
		$to_email=$row_AllUsers['username'];
		$name= $row_AllUsers['name'];
		$surname= $row_AllUsers['surname'];
		$sex = $row_AllUsers['sex'];
		
		//$Message="Почитуван".($sex == '0' ? '' : 'а')." $name $surname, <br /><br />";
		$Message.=$message1;
		$Message.="<span style='color:#666'>Го примивте овој email затоа што се претплативте да добивате инфромации од законот <a href='$url'>$document_title</a> \nPravo.org.mk тимот";
					
					//echo $Message;
		send_mail("Pravo.org.mk","no-reply@pravo.org.mk",$to_email,$subject,$Message);
		
	}while($row_AllUsers = mysql_fetch_assoc($Result_AllUsers));
	
		
}

function weeklyNewslatter($pravo, $database_pravo){
	date_default_timezone_set('Europe/Skopje');
	
	$Query_document=sprintf("SELECT *
							FROM document
							WHERE uploaded_date between subdate(now(), INTERVAL weekday(now()) DAY)
							and adddate(now(), INTERVAL 6-weekday(now()) DAY)");
	$Result_AllDocuments=mysql_query($Query_document, $pravo) or die(mysql_error());
	$row_AllDocuments = mysql_fetch_assoc($Result_AllDocuments);
			
	$body ="
	<html>
		<head>
			<title>Неделен извештај</title>
		</head>
		<body>
			<img src='http://pravo.org.mk/images/pravobanner.png' />
			<table border='0' width='100%' cellspacing='0'>";
  		 do { 
			$timestamp = strtotime($row_Documents['published_date']);
    	$body =."<tr>
      			<td width='100%' style='border-bottom:1px solid #a25852; background:#fae9e8; padding-left:5px;'>	<strong><a href='http://pravo.org.mk/documentDetail.php?id=".$row_Documents['id_document']."&gid=".$row_Documents['id_doc_group']."&tid=".$id_doc_type_Documents".&page=".$page." title='Видете ги деталите за документот'><span style='font-variant:small-caps; font-weight:bolder; font-size:15px; '>".$row_Documents['title'].((isset($row_Documents['into_force']) && !$row_Documents['into_force']) ? '<span style="color: red;"> - вон сила</span>' : "")."</span></a></strong><br> <span style='color:#666; font-size:11px'>&nbsp;".date($page == "courtpractice.php" || $page == "europeancourt.php" ? "Y" : "d.m.Y", $timestamp)."</span>";
				if($page == "documentlaws.php") { $body.="|<span style='color:#666; font-size:11px'> Сл. весник/година:</span> <span style='font-size:11px; font-weight:bold;'>".$row_Documents["ordinal"]." </span>/<span style='font-size:11px; font-weight:bold;'> ".date("Y",strtotime($row_Documents["date"])); 
				}else if($page == "courtpractice.php" || $page == "europeancourt.php") { 
				$body.="|<span style='color:#666; font-size:11px'> Суд:</span> <span style='font-size:11px;'>".$row_Documents["name"].' </span>'; 
				}
				$body.="</span></td>
      <td width='5%' align='right' style='border-bottom:1px solid #a25852; background:#fae9e8;'><a href='http://pravo.org.mk/documentDetail.php?id=".$row_Documents['id_document']."&gid=".$row_Documents['id_doc_group']."&page=".$page." title='Преземи го документот'>";
	  if($row_Documents['mimetype']=="application/msword"){ 
	  $body.="<img src='http://pravo.org.mk/images/word_icon_small3.png' alt='Преземи го документот' title='Преземи го документот' width='35' height='35' border='0' />";
	  }elseif($row_Documents['mimetype']=="text/plain"){ 
	  $body.="<img src='http://pravo.org.mk/images/text_icon_small3.png' alt='Преземи го документот' title='Преземи го документот' width='35' height='35' border='0' />";
	  }else{ 
	  $body.="<img src='http://pravo.org.mk/mages/pdf_icon_small3.png' alt='Преземи го документот' title='Преземи го документот' width='35' height='35' border='0' />";
	  } 
	  $body.="</a></td>
    </tr>
    <tr>
    	<td  style='border-bottom:1px solid #f5e6a2; background:#fbf7e0;' colspan='2'>категорија: ";
		getDocumentCategory($row_Documents['id_doc_group'], $pravo, $database_pravo)
		$body.="</td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>";
    } while ($row_Documents = mysql_fetch_assoc($Documents)); 
$body.="</table>
		</body>
	</html>
	";
echo $body;
//send_mail("Pravo.org.mk","no-reply@pravo.org.mk","dragan.milcevskI@gmail.com",$subject,$body);
}
?>

