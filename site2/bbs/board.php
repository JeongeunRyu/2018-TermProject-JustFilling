<!DOCTYPE html>
<html>
<head>
	<?php require_once("../html_head.php"); ?>
	<style>
		a:hover {text-decoration: none}
	</style>	
</head>
<body>
<?php require_once("../header.php"); ?>
<?php require_once("../menu.php"); ?>

<div class="container">	
	<table class="table table-hover">
		<tr>
			<th>번호</th>	
			<th>제목</th>
			<th>작성자</th>
			<th>작성일시</th>
			<th>조회수</th>
		</tr>
	<?php
		/*
		DB에서 게시글 리스트를 2차원 배열로 가져온다.
		[['Num'=>1, 'Title' => 게시글', 'Writer'=>'scpark', 'Regtime'=>'2018.10.01', 'Hits'=> 0],
		// 나머지도 동일하다.
		 [2, '게시글, 'scpark', '....', 0], 
		 [3, '안녕', 'scpark', '...', 0], 
		 [4, '안영?', 'scpark', '....', 0]
		]

		$msgs = DB에서 2차원 연관 배열 형태로 가져온 각 게시글에 대해
	
		foreach($msgs as $msg) {
			foreach($msg as $val) {
	
			}
		}

		*/

		require_once("BoardDao.php");
		require_once("../tools.php");

		
		/*
		foreach($msgs as $msg) {
			echo "<tr>";
			echo "<td>", $msg["Num"],"</td>";
			echo "<td>", $msg["Title"],"</td>";
			echo "<td>", $msg["Writer"],"</td>";
			echo "<td>", $msg["Regtime"],"</td>";
			echo "<td>", $msg["Hits"],"</td>";
			echo "</tr>";
		}
		*/
		$page = requestValue("page"); // 현재 페이지 
		if ($page < 1)
			$page = 1;

		$dao = new BoardDao();
		//$msgs = $dao->getManyMsgs();
		$startRecord = ($page-1)*10;
		$msgs = $dao->getPageMsgs($startRecord, 10);
		
	?> 
	<?php foreach($msgs as $msg) : ?>
		<tr>
			<td><?= $msg["Num"] ?> </td>			    
			<td><a href="view.php?num=<?= $msg["Num"] ?>&page=<?= $page?>"> <?= $msg["Title"] ?> </a> </td>
			<td><?= $msg["Writer"] ?> </td>
			<td><?= $msg["Regtime"] ?> </td>
			<td><?= $msg["Hits"] ?> </td>
		</tr>
	<?php endforeach ?>	
	</table>	
	<div class="float-right" style="margin-right:50px">	
	<button class="btn btn-primary" onclick="location.href='write_form.php'">글쓰기</button>
	</div>
</div>

<?php
	$numPageLinks = 10; // 한 페이지에 출력할 페이지 링크의 수 
	$numMsgs = 10; // 한 페이지에 출력할 게시글 수 
	$startPage = floor(($page-1)/$numPageLinks)*$numPageLinks+1;
    $endPage = $startPage + ($numPageLinks-1);
    $count = $dao->getTotalCount(); // 전체 게시글 수 
    $totalPages = ceil($count/$numMsgs);
    if($endPage > $totalPages)
    	$endPage = $totalPages;
?>
<?php if($startPage > 1) : ?>
<a href="board.php?page=<?= $startPage - $numPageLinks ?>"> 
	&lt; 
</a>
<?php endif ?>

<?php for($i=$startPage; $i <= $endPage; $i++) : ?>
	 <a href="board.php?page=<?= $i ?>"> 
	 	<?php if($i==$page) :?>
	 		<b>
	 			<?= $i ?> 
	 		</b>
	 	<?php else :?>
	 		<?= $i ?>	
	 	<?php endif ?>
	</a> 

<?php endfor ?>    

<?php if ($endPage < $totalPages) : ?>
	<a href="board.php?page=<?=$endPage+1?>">
		&gt
	</a>	
<?php endif ?>	

<?php require_once("../footer.php"); ?>
</body>


</html>