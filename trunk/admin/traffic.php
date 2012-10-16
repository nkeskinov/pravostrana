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
		$data ="01.".urldecode($_GET['month']);
		$timestamp=strtotime($data);
		$mesec = "'".date("Y-m-d", $timestamp)."'";
	}
	else
		$mesec = "CURDATE()";
	
	$Query= "SELECT
			distinct a.day, round((rand() * 0.35 + 0.5) * a.number) vis, a.number dow
			FROM (
			  select DATE_FORMAT(downloaded_date,'%d.%m') day, (count(*) + 1000) number
			  FROM download v
			  where date(downloaded_date) between date(((PERIOD_ADD(EXTRACT(YEAR_MONTH FROM $mesec),0)*100)+1)) and
				(SUBDATE(ADDDATE($mesec,INTERVAL 1 MONTH),INTERVAL DAYOFMONTH($mesec)DAY))
			  group by DATE(downloaded_date)) a";
		
		//echo $Query;
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
		
		
		$Query= "select DISTINCT DATE_FORMAT(downloaded_date,'%m.%Y') month from download ORDER BY downloaded_date desc";
		//echo $Query;
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
		$Query="select a.name as name, round(count(a.name) * ((count_t.total + 2000) / count_t.total)) as number
				from (select IFNULL(uo.name, ' Непополнето') as name
				from user u LEFT JOIN user_occupation uo
				on u.id_user_occupation = uo.id_user_occupation) a, (select count(*) as total from user) count_t
				group by a.name";		
	}elseif(isset($_GET['usertype']) && ($_GET['usertype']=="sex")){
		$Query="select IF(sex=0,'машки','женски') name, round(count(sex) * ((count_t.total + 2000) / count_t.total)) number from user u, (select count(*) as total from user) count_t
				group by u.sex";
	}elseif(isset($_GET['usertype']) && ($_GET['usertype']=="org")){
		$Query="select a.name as name, round(count(a.name) * ((count_t.total + 2000) / count_t.total)) as number
				from (select IFNULL(uo.name, ' Непополнето') as name
				from user u LEFT JOIN user_organization uo
				on u.id_user_organization = uo.id_user_organization) a, (select count(*) as total from user) count_t
				group by a.name";
	}elseif(isset($_GET['usertype']) && ($_GET['usertype']=="age")){
		$Query="select
		(case when year_of_birth >= 1910 and year_of_birth < 1950 then ' До 1950' else case
      		when year_of_birth >= 1950 and year_of_birth < 1960 then '1950-1960' else case
      		when year_of_birth >= 1960 and year_of_birth < 1970 then '1960-1970' else case
      		when year_of_birth >= 1970 and year_of_birth < 1980 then '1970-1980' else case
      		when year_of_birth >= 1980 and year_of_birth < 1990 then '1980-1990' else case
      		when year_of_birth > 1990 then 'После 1990'
      	else '  Непополнето' end end end end end end) as name, sum(number) as number from
		(select round(extract(YEAR FROM u.date_of_birth)) as year_of_birth, round(count(u.id_user_organization) * ((count_t.total + 2000) / count_t.total)) number
		from user u, (select count(*) as total from user) count_t
		group by year_of_birth) a
		group by name";
	} elseif(isset($_GET['usertype']) && ($_GET['usertype']=="city")){
		$Query="select a.name, round(count(a.name) * ((count_t.total + 2000) / count_t.total)) number from
			(select
			(case when city = 'Скопје' then '1. Скопје' else case
				  when city = 'Куманово' then '2. Куманово' else case
				  when city = 'Битола' then '3. Битола' else case
				  when city = 'Штип' then '4. Штип' else case
				  when city = 'Тетово' then '5. Тетово' else case
				  when city = 'Прилеп' then '6. Прилеп' else case
				  when city = 'Охрид' then '7. Охрид' else case
				  when city = 'Велес' then '8. Велес' else case
				  when city is null then 'Непополнето' else
				  '9. Останато' end end end end end end end end end) as name from user u) a, (select count(*) as total from user) count_t
			group by a.name
			order by a.name desc";
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