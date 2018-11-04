<?php
	require_once("../tools.php");
	
	sessionStartIfNone();

	unset($_SESSION["uid"]);
	unset($_SESSION["name"]);

	goNow(MAIN_PAGE);

?>