<?php 
	$helpid = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php switch($helpid) {
	case 1 : ?>
<div style="padding:5px;"><strong>ЗАКОНИ </strong><br />
  <span><br />
Базата  содржи  закони донесени од страна на Собранието на Република Македонија.</span><br />
<br />
Кога се врши пребарување по буква како почетна буква се смета првата буква од зборот кој доаѓа после зборовите Закон за ... <br />
<br />
Напредното пребарување вклучува пребарување по името на законот, пребарување по групата во која спаѓа конкретниот закон, како и број и година на Службениот весник во кој е објавен или по збор кој е содржан во текстот на законот. Пребарувањето може да се врши истовремено во сите полиња или може да се пребарува посебно во секое поле. Доколку пребарувањето се изврши без пополнување на полињата тогаш се прикажуваат сите закони кои ги содржи базата на податоци. </span> </div>
<?php break; ?>
<?php } ?>
<div align="right">
  <input type="submit" name="button" id="button" onclick="JavaScript:window.close();" value="Затвори прозорец" />
</div>
</body>
</html>