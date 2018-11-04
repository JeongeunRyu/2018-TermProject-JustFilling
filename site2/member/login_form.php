<!DOCTYPE html>
<html>
<head>
	<?php require_once("../html_head.php"); ?>
</head>
<body>
	<?php require_once("../tools.php"); ?>
	<?php require_once("../header.php"); ?>
	<?php require_once("../menu.php"); ?>
	<?php $loginFlag = isLogin(); ?>
	<?php if($loginFlag==false ) : ?>
		
			<form action="login.php" method="post">	
				<div class="form-group">
					아이디: <input class="form-control" type="text" name="id"> 
				</div>
				<div class="form-group">
					암호: <input class="form-control" type="password" name="pw"> 
				</div>	
				<div class="form-group">	
					<input class="btn btn-primary" type="submit" value="로그인"> 
				</div>	
			</form>	
			<button class="btn btn-warning" 
				onclick="location.href='member_join_form.php'">회원가입
			</button>
		
		 
	<?php else : ?>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<h3><?= $_SESSION["name"]?>님 환영합니다.</h3>
			</div>
			<div class="col-sm-3">	
				<button class="btn btn-danger" 
					onclick="location.href='logout.php'">로그아웃</button>
			</div>		
		</div>		
	<?php endif ?>

	<?php require_once("../footer.php"); ?>
</body>
</html>
