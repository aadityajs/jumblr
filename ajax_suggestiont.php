<?php
require("config.inc.php");
require("class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
error_reporting(E_ERROR && E_STRICT);
session_start();
//print_r($_SESSION);

	$sugg = $_REQUEST['showSugg'];
	$deal_id = $_REQUEST['deal_id'];
	$details = $_REQUEST['details'];

	$date = time();

	if (isset($_SESSION['fb_id'])) {
		$sql_sugg= "SELECT * FROM ".TABLE_FB_USER;
		$suggUserRes = mysql_query($sql_sugg);
		echo '<ul>';
		while ($suggUserRow = mysql_fetch_array($suggUserRes)) {
			//$html = $suggUserRow[name];
			echo '<li class="jqSuggListClick"><a href="javascript: void(0);" onclick="appendtext(\''.$suggUserRow[name].'\')"><img src="'.$suggUserRow[pic_square].'" alt="" width="30" height="30" align="absmiddle" />'.$suggUserRow[name].'</a></li>';
		}
		echo '</ul>';
	}

	/*
	 * <ul>
         	<li><a href="#"><span><img src="images/google_icon.png" alt="" width="17" height="17" /></span>asaSAsaS</a></li>
            <li><a href="#"><span><img src="images/google_icon.png" alt="" width="17" height="17" /></span>asaSAsaS</a></li>
            <li><a href="#"><span><img src="images/google_icon.png" alt="" width="17" height="17" /></span>asaSAsaS</a></li>
            <li><a href="#"><span><img src="images/google_icon.png" alt="" width="17" height="17" /></span>asaSAsaS</a></li>
            <li><a href="#"><span><img src="images/google_icon.png" alt="" width="17" height="17" /></span>asaSAsaS</a></li>
            <li><a href="#"><span><img src="images/google_icon.png" alt="" width="17" height="17" /></span>asaSAsaS</a></li>
        </ul>
	 */

?>
<script>
function appendtext(mtext){
	cntent=document.getElementById("comment").value
	document.getElementById("comment").value=cntent+mtext;
	$("#dropBox").slideUp(400);

}
</script>