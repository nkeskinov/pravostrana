<?php
require_once("../Connections/pravo.php");

$dom = new DomDocument();
$dom->formatOutput = true;

$root = $dom->createElement( "traffic" );
$dom->appendChild( $root );

if(isset($_GET['month'])){
	$data ="01.".$_GET['month'];
	$timestamp=strtotime($data);
	$mesec = "'".date("Y-m-d", $timestamp)."'";
}
else
	$mesec = "CURDATE()";

	mysql_select_db($database_pravo, $pravo);
	$Query= "SELECT distinct a.day, a.number vis, b.number dow FROM
(select DATE_FORMAT(visited_date,'%d.%m.%Y') day, count(*) number FROM visit v
where date(visited_date) between date(((PERIOD_ADD(EXTRACT(YEAR_MONTH FROM ".$mesec."),0)*100)+1))
and (SUBDATE(ADDDATE(".$mesec.",INTERVAL 1 MONTH),INTERVAL DAYOFMONTH(".$mesec.")DAY))
group by DATE(visited_date) )a LEFT JOIN
(select DATE_FORMAT(downloaded_date,'%d.%m.%Y') day, count(*) number FROM download v
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
	
	header( "Content-type: text/xml" );
	echo $dom->saveXML();
?>