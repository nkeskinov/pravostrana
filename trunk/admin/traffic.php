<?php
require_once("../Connections/pravo.php");

$dom = new DomDocument();
$dom->formatOutput = true;

$root = $dom->createElement( "traffic" );
$dom->appendChild( $root );
mysql_select_db($database_pravo, $pravo);
$mode="stat";
if(isset($_GET['mode']) && ($_GET['mode']=="stat")){
	$mode="stat";
}if(isset($_GET['mode']) && ($_GET['mode']=="users")){
	$mode="users";
}

if($mode=="stat"){

	if(isset($_GET['month'])){
		$data ="01.".$_GET['month'];
		$timestamp=strtotime($data);
		$mesec = "'".date("Y-m-d", $timestamp)."'";
	}
	else
		$mesec = "CURDATE()";
	
	$Query= "SELECT distinct a.day, a.number vis, b.number dow FROM
	(select DATE_FORMAT(visited_date,'%d.%m') day, count(*) number FROM visit v
	where date(visited_date) between date(((PERIOD_ADD(EXTRACT(YEAR_MONTH FROM ".$mesec."),0)*100)+1))
	and (SUBDATE(ADDDATE(".$mesec.",INTERVAL 1 MONTH),INTERVAL DAYOFMONTH(".$mesec.")DAY))
	group by DATE(visited_date) )a LEFT JOIN
	(select DATE_FORMAT(downloaded_date,'%d.%m') day, count(*) number FROM download v
	where date(downloaded_date) between date(((PERIOD_ADD(EXTRACT(YEAR_MONTH FROM ".$mesec."),0)*100)+1))
	and (SUBDATE(ADDDATE(".$mesec.",INTERVAL 1 MONTH),INTERVAL DAYOFMONTH(".$mesec.")DAY))
	group by DATE(downloaded_date)) b
	ON a.day=b.day";
		
	//	echo $Query;
		$Recordset = mysql_query($Query, $pravo) or die(mysql_error());
		$row = mysql_fetch_assoc($Recordset);
		$days = $dom->createElement( "days" );
		$root->appendChild( $days );
		do{
			$dn = $dom->createElement( "day" );
			$dn->setAttribute( 'day', $row['day'] );
			$dn->setAttribute( 'number', $row['vis'] );
			$dn->setAttribute( 'download', $row['dow'] );
			$days->appendChild( $dn );
		}while ($row = mysql_fetch_assoc($Recordset));
		
		
		$Query= "select  DISTINCT DATE_FORMAT(visited_date,'%m.%Y') month from visit ORDER BY visited_date desc";
		$Recordset = mysql_query($Query, $pravo) or die(mysql_error());
		$row = mysql_fetch_assoc($Recordset);
		$months = $dom->createElement( "months" );
		$root->appendChild( $months );
		do{
			$dn = $dom->createElement( "month" );
			$dn->setAttribute( 'month', $row['month'] );
			$months->appendChild( $dn );
		}while ($row = mysql_fetch_assoc($Recordset));
		
		
}elseif($mode=="users"){
	if(isset($_GET['usertype']) && ($_GET['usertype']=="ocu")){
		$Query="select uo.name name, count(u.id_user_occupation) number from user u, user_occupation uo
				where u.id_user_occupation=uo.id_user_occupation and u.is_approved=1
				group by u.id_user_occupation";		
	}elseif(isset($_GET['usertype']) && ($_GET['usertype']=="sex")){
		$Query="select IF(sex=0,'машки','женски') name, count(sex) number from user u
				where u.is_approved=1
				group by u.sex";
	}else{
		$Query="select uo.name name, count(u.id_user_organization) number from user u, user_organization uo
			where u.id_user_organization=uo.id_user_organization and u.is_approved=1
			group by u.id_user_organization";
	}
	$Recordset = mysql_query($Query, $pravo) or die(mysql_error());
	$row = mysql_fetch_assoc($Recordset);
	$users = $dom->createElement( "users" );
	$root->appendChild( $users );
	
	do{
		$dn = $dom->createElement( "chart" );
		$dn->setAttribute( 'name', $row['name'] );
		$dn->setAttribute( 'number', $row['number'] );
		$users->appendChild( $dn );
	}while ($row = mysql_fetch_assoc($Recordset));
}
header( "Content-type: text/xml" );
echo $dom->saveXML();									   
									  
?>