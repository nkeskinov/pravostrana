<?php
if (!isset($_SESSION)) {
  session_start();
}
$upload_dir = "../download/tmp"; // Directory for file storing
                                            // filesystem path
$web_upload_dir = "download/tmp"; // Directory for file storing
                          // Web-Server dir 

/* upload_dir is filesystem path, something like
   /var/www/htdocs/files/upload or c:/www/files/upload

   web upload dir, is the webserver path of the same
   directory. If your upload-directory accessible under 
   www.your-domain.com/files/upload/, then 
   web_upload_dir is /files/upload
*/

// testing upload dir 
// remove these lines if you're shure 
// that your upload dir is really writable to PHP scripts
$tf = $upload_dir.'/'.md5(rand()).".test";
$f = @fopen($tf, "w");
if ($f == false) {
    die("Fatal error! {$upload_dir} is not writable. Set 'chmod 777 {$upload_dir}'
        or something like this");
	//chmod($upload_dir,0777);	
	//chmod($web_upload_dir,0777);	
}
fclose($f);
unlink($tf);

// end up upload dir testing 



// FILEFRAME section of the script
if (isset($_POST['fileframe'])) 
{
    $result = 'ERROR';
    $result_msg = 'No FILE field found';
	
    if (isset($_FILES['file']))  // file was send from browser
    {
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK)  // no error
        {
            $filename = $_FILES['file']['name']; // file name 
			$_SESSION['filename']=$filename;
			$_SESSION['filetype']=$_FILES['file']['type'];
			$_SESSION['filesize'] = $_FILES['file']['size'];
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir.'/'. basename( $_FILES['file']['name']));
            // main action -- move uploaded file to $upload_dir 
            $result = 'OK';
        }
        elseif ($_FILES['file']['error'] == UPLOAD_ERR_INI_SIZE)
            $result_msg = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        else 
            $result_msg = 'Непозната грешка';

        // you may add more error checking
        // see http://www.php.net/manual/en/features.file-upload.errors.php
        // for details 
    }

    // outputing trivial html with javascript code 
    // (return data to document)
	
    // This is a PHP code outputing Javascript code.
    // Do not be so confused ;) 
    echo '<html><head><title>-</title></head><body>';
    echo '<script language="JavaScript" type="text/javascript">'."\n";
    echo 'var parDoc = window.parent.document;';
    // this code is outputted to IFRAME (embedded frame)
    // main page is a 'parent'
	
    if ($result == 'OK')
    {
        // Simply updating status of fields and submit button
        echo 'parDoc.getElementById("upload_status").value = "Документот е успешно закачен";';
        echo 'parDoc.getElementById("filename").value = "'.$filename.'";';
        echo 'parDoc.getElementById("title").value = "'.htmlentities(lat2cyr(str_replace(".pdf","",str_ireplace("_"," ",$filename))), ENT_COMPAT, 'UTF-8').'";';
        echo 'parDoc.getElementById("upload_button").disabled = false;';
    }
    else
    {
        echo 'parDoc.getElementById("upload_status").value = "ERROR: '.$result_msg.'";';
    }

    echo "\n".'</script></body></html>';

    exit(); // do not go futher 
}

?>