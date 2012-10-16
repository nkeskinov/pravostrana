<?php
header('Content-Type: text/xml; charset=utf-8');

$host="localhost";
$user="righttoknow";
$password="righttoknow";
$database="righttoknow";

if (isset($_GET["entry_set"])) {
    $entry_set = $_GET["entry_set"];
} else {
    // todo: set default here
    $entry_set = 1;
}

// connect to database
mysql_connect($host, $user, $password)
    or die ('Unable to connect to server.');

mysql_set_charset('utf8');

mysql_select_db($database)
    or die ('Unable to select database.');

$query =
    "select entries.`value`, entries.`year`, municipalities.`name`, municipalities.map_id ".
    "from entries, municipalities ".
    "where entries.id_entry_set = $entry_set ".
         "and entries.id_municipality = municipalities.id_municipality ".
         " order by `year` asc";
$res = mysql_query($query);

// put all the data inside an array
$arr = array();
while($obj = mysql_fetch_object($res)){
    $arr[] = $obj;
}

// echo xml
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
echo "<timeline swf_file=\"maps/ammap.swf\"
          settings_file=\"maps/ammap_settings.xml\"
          slider_x=\"60\" 
          slider_y=\"!35\"
          slider_width=\"600\"
          font=\"Arial\"  
          text_color=\"#000000\"
          text_size=\"11\"
          max_date_count=\"12\"
          date_text_color=\"#000000\"
          date_x=\"80%\"
          date_y=\"72%\"
          date_text_size=\"70\"
          delay=\"1\"
          loop=\"false\"
          autoplay=\"false\"
          control_color=\"#444444\">\n";

    if (sizeof($arr) > 0) {
        $year = $arr[0] -> year;
        echo "<data_set date=\"$year\">\n";
        echo "<map map_file=\"macedonia.swf\" zoom=\"86.6071%\" zoom_x=\"7.74%\" zoom_y=\"10.62%\">\n";
        echo "<areas>\n";
        for ($i = 0; $i < sizeof($arr); $i++) {
            if ($year != $arr[$i] -> year) {
                $year = $arr[$i] -> year;
                echo "</areas>\n";
                echo "</map>\n";
                echo "</data_set>\n";
                echo "<data_set date=\"$year\">\n";
                echo "<map map_file=\"macedonia.swf\" zoom=\"86.6071%\" zoom_x=\"7.74%\" zoom_y=\"10.62%\">\n";
                echo "<areas>\n";
            }
            // todo: check if intval is really needed
            $value = intval($arr[$i] -> value);
            $municipality = $arr[$i] -> name;
            $municipality_id = $arr[$i] -> map_id;
            echo "<area value=\"$value\" mc_name=\"$municipality_id\" title=\"$municipality\"></area>\n";
        }
        echo "</areas>\n";
        echo "</map>\n";
        echo "</data_set>\n";
    }

    echo "</timeline>";

?>