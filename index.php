<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <?php require_once ("pages/htmlHead.php"); ?>
	<style>
@import url('https://fonts.googleapis.com/css?family=Nanum+Myeongjo:800');

	body{
		text-align: center;
		background-color: #DBC5DB;
		overflow: hidden;
		font-family: 'Nanum Myeongjo', serif;

	}
	#mainlogo{
		position:fixed;
		margin-top: 16%;
		margin-left: 8%;
	}
	#mcr{
		position:fixed;
		margin-top: 15.5%;
		margin-left: 36.5%;

	}
	#msg{

		color: white;
		position: fixed;
		margin-top: 28%;
		margin-left: 90%;
		font-size: 0.6em;
		letter-spacing: 1em;

	}

	#mainvideo {
			 position: fixed;
			 top: -15%;
			 left: 0px;
			 min-width : 100%;
			 z-index: -1;
	}

	::-moz-selection {
			color: white;
			background: #7A5C99;
	}

	::selection {
			color: white;
			background: #7A5C99;
	}


	</style>
</head>

<body>
	<div id="body">


	<?php
		//term-project main page
	 ?>

	 <div class="logo_img">
		 <img id="mainlogo"src="media/jflogo_white.png" width="40%">
		 <a href="pages/home.php"><img id="mcr"src="media/mcr.png" width="12%"></a>
		 <p id="msg">Click!</p>
	 </div>
		 <video id="mainvideo" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
			 <source src="media/video.mp4"></video>
	</div>

		</div>
			<script src="js/main.js"></script>
</body>
</html>
