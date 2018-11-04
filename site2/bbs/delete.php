<?php
	/*
	클라이언트가 넘겨준 게시글 번호를 받아서
   1번에서 구현한 delete 메소드를 호출해 레코드를 삭제
   다시 board.php로 돌아간다.
	*/
   require_once("../tools.php");
   require_once("BoardDao.php");

   $num = requestValue("num");

	$dao = new BoardDao();
 
 	$dao->deleteMsg($num);
  
   header("Location: board.php"); 
?>