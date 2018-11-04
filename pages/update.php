<?php
/*
request정보에서 id, pw, name추출
데이터베이스에 저장된 회원정보 수정
mainpage로 이동
*/
  require_once("tools.php");
  require_once("MemberDao.php");

//회원 수정 폼에 입력된 데이터 읽기
  $id=requestValue("id");
  $pw=requestValue("pw");
  $name=requestValue("name");
  $mobile=requestValue("mobile");
  $grade=requestValue("grade");


readSessionVar("uid");
/*
    1. 로그인한 사용자인지 check
    2. 본인의 회원정보를 수정하려는 것인지 check
*/

  $suid=isset($_SESSION["uid"])?$_SESSION["uid"]:"";
  //미 로그인 상태인 경우
  if(!$suid){
    errorBack("로그인부터 해 주세요.");
  }else{
    //타인의 정보를 수정하려고 하는 경우
    if($suid !=$id)
      errorBack("본인의 정보가 아닙니다.");
  }


//모든 입력란이 채워져 있으면 회원정보 업데이트
  if($id && $pw && $name && $mobile && $grade){
    $mdao=new MemberDao();
    $mdao->updateMember($id, $pw, $name, $mobile, $grade);
    $_SESSION["uname"]=$name;
    $_SESSION["ugrade"]=$grade;

    okGo("회원정보가 수정되었습니다.",MAIN_PAGE);
  }else {
    errorBack("모든 입력란을 채워주세요.");
  }

 ?>
