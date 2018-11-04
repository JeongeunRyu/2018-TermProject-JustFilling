<?php
	/*
		1. 클리어언트로부터 전송되어오 num 값을 추출
		2. 그 num 값으로 DB에서 게시글 레코드를 읽고
		3. 그 읽은 레코드를 이용해서 
		   게시글 상세정보를 html로 만든다.
	*/
	require_once("../tools.php");
	require_once("BoardDao.php");
	$num = requestValue("num");
	$page = requestValue("page");
	$dao = new BoardDao();
	$dao->increaseHits($num);
	$msg = $dao->getMsg($num);
?>
<html>
<head>
<?php require_once("../html_head.php"); ?>	

	<script>
		function processDelete(num) {
			result = confirm("Are you sure?");
			if(result) {
				location.href="delete.php?num="+num;
			}
		}
	</script>
</head>
<body>

	<?php require_once("../header.php"); ?>
	<?php require_once("../menu.php"); ?>
	
	<div class="form-group">
		<label for="title">제목: </label>
		<input type="text" id="title" class="form-control" value="<?=$msg["Title"] ?>" >
	</div>
	
	<div class="form-group">
		<label for="writer">작성자: </label>
		<input type="text" id="writer" class="form-control" value="<?="[".$msg["Writer"] ."]" ?>" >
	</div>

	<div class="form-group">
		<label for="regtime">작성일자: </label>
		<input type="text" id="regtime" class="form-control" value="<?=$msg["Regtime"] ?>" readonly>
	</div>


	<div class="form-group">
		<label for="hits">조회수: </label>
		<input type="text" id="hits" class="form-control" value="<?=$msg["Hits"] ?>" readonly>
	</div>

	
	<div class="form-group">
		<label for="content">내용: </label>
		<textarea rows="5" id="content"
			class="form-control" ><?=$msg["Content"] ?></textarea>
		<button onclick="location.href='board.php?page=<?=$page ?>'" type="submit" class="btn btn-primary">목록보기</button>	
		<?php 
		$loginFlag = isLogin();	
		$writer = $msg["Writer"];
		$mygul = isMyArticle($writer);
		if($loginFlag && $mygul) { ?>  
			<button class="btn btn-warning"
			onclick="location.href='modify_form.php?num=<?= $msg["Num"] ?>'">수정</button>
			<button type="submit" 
				onclick="processDelete(<?= $msg["Num"] ?>)"
			class="btn btn-danger">삭제하기</button>	
		<?php } ?>	
	</div>	
	<?php require_once("../footer.php"); ?>	
</body>
</html>