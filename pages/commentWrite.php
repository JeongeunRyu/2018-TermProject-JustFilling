<?php
require_once ("tools.php");
$comment = requestValue("comment");
$cwriter = requestValue("writer");
require_once ("BoardDao.php");
$dao=new BoardDAO();

$num = requestValue("num");
$page = requestValue("page");
$url= bdURL("view.php",$num,$page);
$dao->insertCmt($num,$cwriter,$comment);
session_start();


okGo("덧글입력", $url);



//페이지랑 넘 불로오기
?>



