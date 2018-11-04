<?php
  require_once("tools.php");
  readSessionVar("uid");
//세션변수에서 로그인 정보 삭제
  unset($_SESSION["uid"]);// unset() 변수 삭제하는 php 내장함수.
  unset($_SESSION["uname"]);
//메인 페이지로 돌아감.
  goNow(MAIN_PAGE);
 ?>
