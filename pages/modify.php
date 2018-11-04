<?php

require_once("tools.php");
require_once("BoardDao.php");
$page = requestValue("page");
$num = requestValue("num");
$title = requestValue("title");
$writer = requestValue("writer");
$content = requestValue("content");

session_start();
$nowBoard = sessionVar("nowBoard");


if ($title && $writer && $content) {
    $dao = new BoardDao();
    if($nowBoard=="board"){
        $dao->updateMsg("jfboard",$num,$title,$writer,$content);
    }elseif ("board2"){
        $dao->updateMsg("jfboard2",$num,$title,$writer,$content);
    }

    okGo("수정되었습니다", bdUrl($nowBoard.".php",0,$page));
} else {
    errorBack("모든 항목이 빈칸 없이 입력되어야 합니다.");
}

?>