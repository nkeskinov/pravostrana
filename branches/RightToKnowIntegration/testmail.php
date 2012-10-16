<?php

//ini_set('include_path', 'inc/');
require_once ('Zend/Mail.php');
$mail = new Zend_Mail();
$mail->setBodyText('This is the text of the mail.');
$mail->setFrom('contact@pravo.org.mk', 'Драган Милчевски');
$mail->addTo('nkeskinov@gmail.com', 'Nikola Keskinov');
$mail->setSubject('TestSubject');
$mail->send();


 
?>