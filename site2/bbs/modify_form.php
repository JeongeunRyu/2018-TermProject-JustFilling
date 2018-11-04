<!DOCTYPE html>
<html>
<head>
	<?php require_once("../html_head.php"); ?>	
</head>
<body>
	<?php require_once("../header.php"); ?>
	<?php require_once("../menu.php"); ?>
	
	<?php
		require_once("BoardDao.php");
		require_once("../tools.php")	;
		
		$num = requestValue("num");	
		
		$dao = new BoardDao();
		$msg = $dao->getMsg($num);
	?>

	<form action="modify.php" method="post">
		<input type="text" name="num" 
		value="<?= $msg["Num"] ?>" readonly
		hidden>
		<div class="form-group">
			<label for="title">제목: </label>
			<input type="text" id="title" name="title" class="form-control" 
			value="<?= $msg["Title"] ?>"
			required>
		</div>
		
		<div class="form-group">
			<label for="writer">작성자: </label>
			<input type="text" id="writer" name="writer" class="form-control"
			value="<?= $msg["Writer"] ?>"
			 required>
		</div>
		
		<div class="form-group">
			<label for="content">내용: </label>
			<textarea rows="5" id="content"
			name="content" class="form-control" required><?= $msg["Content"] ?></textarea>
			<button type="submit" 
				class="btn btn-primary">수정</button>	
			<button type="button" onclick="location.href='board.php'" class="btn btn-danger">목록보기</button>
		</div>		
	</form>		
<?php require_once("../footer.php"); ?>
</body>
</html>