<!DOCTYPE html>
<html>
<head>
	<?php require_once("../html_head.php"); ?>	
</head>
<body>
	<?php require_once("../header.php"); ?>
	<?php require_once("../menu.php"); ?>

	<form action="write.php" method="post">
		<div class="form-group">
			<label for="title">제목: </label>
			<input type="text" id="title" name="title" class="form-control" required>
		</div>
		
		<div class="form-group">
			<label for="writer">작성자: </label>
			<input type="text" id="writer" name="writer" class="form-control" required>
		</div>
		
		<div class="form-group">
			<label for="content">내용: </label>
			<textarea rows="5" id="content"
			name="content" class="form-control" required></textarea>
			<button type="submit" class="btn btn-primary">글등록</button>	
			<button onclick="location.href='board.php'" class="btn btn-danger">목록보기</button>
		</div>		
	</form>		
<?php require_once("../footer.php"); ?>
</body>
</html>