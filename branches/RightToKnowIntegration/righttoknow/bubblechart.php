<?php
header('Content-Type: text/xml; charset=utf-8');

$host="localhost";
$user="righttoknow";
$password="righttoknow";
$database="righttoknow";

if (isset($_GET["x"], $_GET["y"])) {
    $x_axis = $_GET["x"];
    $y_axis = $_GET["y"];
} else {
    // todo: set default here
    $x_axis = 1;
    $y_axis = 2;
}

// connect to database
mysql_connect($host, $user, $password)
    or die ('Unable to connect to server.');

mysql_set_charset('utf8');

mysql_select_db($database)
    or die ('Unable to select database.');

$query =
    "select x_entry_set.`value` as x, y_entry_set.`value` as y, municipalities.`name`, x_entry_set.`year` ".
    "from entries as x_entry_set, entries as y_entry_set, municipalities ".
    "where x_entry_set.id_entry_set = $x_axis ".
         "and y_entry_set.id_entry_set = $y_axis ".
         "and x_entry_set.`year` = y_entry_set.`year` ".
         "and x_entry_set.id_municipality = y_entry_set.id_municipality ".
         "and x_entry_set.id_municipality = municipalities.id_municipality ".
         " order by `year` asc";
$res = mysql_query($query);

// put all the data inside an array
$arr = array();
while($obj = mysql_fetch_object($res)){
    $arr[] = $obj;
}

// echo xml
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
echo "<timeline swf_file=\"charts/amxy.swf\"
        settings_file=\"charts/settings.xml\"
        slider_x=\"60\"
        slider_y=\"!35\"
        slider_width=\"680\"
        font=\"Arial\"
        text_color=\"#000000\"
        text_size=\"11\"
        max_date_count=\"12\"
        date_text_color=\"#dddddd\"
        date_x=\"80%\"
        date_y=\"72%\"
        date_text_size=\"70\"
        delay=\"0.1\"
        loop=\"false\"
        autoplay=\"false\">\n";

    if (sizeof($arr) > 0) {
        $year = $arr[0] -> year;
        echo "<data_set date=\"$year\">\n";
        echo "<chart>\n";
        echo "<graphs>\n";
        echo "<graph gid=\"0\">\n";
        for ($i = 0; $i < sizeof($arr); $i++) {
            if ($year != $arr[$i] -> year) {
                $year = $arr[$i] -> year;
                echo "</graph>\n";
                echo "</graphs>\n";
                echo "</chart>\n";
                echo "</data_set>\n";
                echo "<data_set date=\"$year\">\n";
                echo "<chart>\n";
                echo "<graphs>\n";
                echo "<graph gid=\"0\">\n";
            }
            // todo: check if intval is really needed
            $x_value = intval($arr[$i] -> x);
            $y_value = intval($arr[$i] -> y);
            $municipality = $arr[$i] -> name;
            echo "<point x=\"$x_value\" y=\"$y_value\">$municipality</point>\n";
        }
        echo "</graph>\n";
        echo "</graphs>\n";
        echo "</chart>\n";
        echo "</data_set>\n";
    }

    echo "</timeline>";

?>