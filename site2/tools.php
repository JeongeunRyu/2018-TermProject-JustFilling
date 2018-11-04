<?php
	define("MAIN_PAGE", "/site2/index.php");

	function requestValue($name) {
		return isset($_REQUEST[$name])?$_REQUEST[$name]:"";
	}


	function errorBack($msg) {
		/*
		echo"<script>
					alert(", $msg, ");
					location.href = 'member_join_form.php'; 
				</script> ";
		<script>
			alert(이미 사용중인 아이디입니다.);
			location.href='member_join_form.php';
		</script>		
		*/
	?>
		<script>
			alert('<?= $msg ?>');
			history.back();
		</script>		

	<?php	
		exit();

	}

	function okGo($msg, $url) {
    ?>
		<script>
				alert('<?= $msg ?>');
				location.href = '<?= $url ?>';
		</script>
		
    <?php
    	exit();

	}


	function goNow($url) {
    ?>
		<script>				
				location.href = '<?= $url ?>';
		</script>
		
    <?php
    	exit();

	}
	function sessionStartIfNone() {
		if(session_status() == PHP_SESSION_NONE)
			session_start();
	}

	function isLogin(){
		sessionStartIfNone();
		return isset($_SESSION["uid"]);
	}

	function isMyArticle($writer) {
		sessionStartIfNone();
		if(isset($_SESSION["name"]))
			return $writer == $_SESSION["name"];

		return false;
	}

?>
