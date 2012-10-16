<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<?php

function getBanner($database_pravo, $pravo, $position){
	mysql_select_db($database_pravo, $pravo);
	$query_Banner = sprintf("SELECT * FROM banner WHERE position = %s AND visible = 1",GetSQLValueString($position, "int"));
	$Recordset_Banner = mysql_query($query_Banner, $pravo) or die(mysql_error());
	$row_Banner = mysql_fetch_assoc($Recordset_Banner);
	$totalRows_Banner = mysql_num_rows($Recordset_Banner);
	//echo $row_Banner['mimetype'];
	if($row_Banner['mimetype'] == "image/jpeg" || $row_Banner['mimetype'] == "image/gif" || $row_Banner['mimetype'] == "image/png") {
		if($row_Banner['url']!=NULL){
			echo '<a href="'.$row_Banner['url'].'"><img src="'.$row_Banner['path'].'" border="0"/></a>';
		}else{
			echo '<img src="'.$row_Banner['path'].'"/>';
		}
	}
	elseif($row_Banner['mimetype'] == "application/x-shockwave-flash"  ) { ?>		
		<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
          <param name="movie" value="<?php echo $row_Banner['path']; ?>" />
          <param name="quality" value="high" />
          <param name="wmode" value="opaque" />
          <param name="swfversion" value="6.0.65.0" />
          <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
          <param name="expressinstall" value="Scripts/expressInstall.swf" />
          <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
          <!--[if !IE]>-->
          <object type="application/x-shockwave-flash" data="<?php echo $row_Banner['path']; ?>" width="728" height="90">
            <!--<![endif]-->
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="6.0.65.0" />
            <param name="expressinstall" value="Scripts/expressInstall.swf" />
            <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
            <div>
              <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
              <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
            </div>
            <!--[if !IE]>-->
          </object>
          <!--<![endif]-->
        </object>
        <script type="text/javascript">
        <!--
        swfobject.registerObject("FlashID");
        //-->
        </script>
	<?php }
	
}
?>