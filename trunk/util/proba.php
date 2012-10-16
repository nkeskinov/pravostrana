<?php 
echo date("d.m.Y");
echo "<br>";
echo date("d.m.Y")+30; 
echo "<br>";
$curdate = date("d.m.Y");
$term = 30;
$expdate = date( "d.m.Y", mktime(0, 0, 0, date("m"), date("d")+$term, date("y")) );
echo $curdate . "<br>" . $expdate;
?>

<a href="http://pravo.org.mk.previewdns.com/pravo.org.mk/" >Pravo.org.mk</a>