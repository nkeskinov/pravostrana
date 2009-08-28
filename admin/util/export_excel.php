<?php require_once("../../Connections/pravo.php"); ?>
<?php

mysql_select_db($database_pravo, $pravo);
$query_VisitedPages = sprintf("SELECT vis.id_visit, p.id_page, p.title page, p1.title from_page,visited_date, ip, browser, language, referrer, (select count( * ) from page_visit pvs   where pvs.id_page = p.id_page and pvs.id_visit = vis.id_visit group by p.id_page) as visits FROM visit vis, page p, page_visit pv LEFT JOIN page p1 on pv.id_from_page = p1.id_page where vis.id_visit = pv.id_visit AND pv.id_page = p.id_page AND id_user = %s GROUP BY vis.id_visit, p.id_page ORDER BY visited_date desc",9);

$Use_Title = 1;
//define date for title: EDIT this to create the time-format you need
$now_date = date('m-d-Y H:i');
//define title for .doc or .xls file: EDIT this if you want
$title = "Dump For Table from Database on $now_date";

mysql_select_db($database_pravo, $pravo);

$result = mysql_query($query_VisitedPages, $pravo) or die(mysql_error());
$file_type = "vnd.ms-excel";
$file_ending = "xls";

//header info for browser: determines file type ('.doc' or '.xls')
header("Content-Type: application/$file_type; charset=utf-8");
header("Content-Disposition: attachment; filename=database_dump.$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

/*	FORMATTING FOR EXCEL DOCUMENTS ('.xls')   */
	//create title with timestamp:
	if ($Use_Title == 1)
	{
		echo("$title\n");
	}
	//define separator (defines columns in excel & tabs in word)
	$sep = "\t"; //tabbed character

	//start of printing column names as names of MySQL fields
	for ($i = 0; $i < mysql_num_fields($result); $i++)
	{
		echo mysql_field_name($result,$i) . "\t";
	}
	print("\n");
	//end of printing column names

	//start while loop to get data
	while($row = mysql_fetch_row($result))
	{
		//set_time_limit(60); // HaRa
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		//following fix suggested by Josue (thanks, Josue!)
		//this corrects output in excel when table fields contain \n or \r
		//these two characters are now replaced with a space
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		print(trim($schema_insert));
		print "\n";
	}

?>