<?php

  require_once("tools.php");
  require_once("MemberDao.php");

    //로그인 폼에서 전달된 아이디, 비밀번호 읽기
  $id=requestValue("id");
  $pw=requestValue("pw");


    // 로그인 폼에 입력된 아이디의 회원정보 DB에서 읽기
  $mdao = new MemberDao();//DAO 클래스를 호출 >> DB와 연결 완료!
  $member =$mdao->getMember($id);

    //입력된 아이디를 가진 레코드가 있고, 비밀번호가 맞으면, 로그인 !
  if($member && $member["pw"] == $pw){
      //로그인 성공
      //세션에 로그인 성공 정보를 기록

    readSessionVar("uid");
      $_SESSION["uid"] = $id; // 로그인 여부 확인시, 세션변수 uid값의 여부 확인.
      $_SESSION["uname"] = $member["name"];
      $_SESSION["ugrade"] = $member["grade"];

      ?>
      <script>
          alert("로그인성공");
      history.back();

      </script>
      <?php

  }else {
    //로그인 실패 - 에러메세지 출력 후 이전 페이지로 돌아감.
    okGo("로그인실패","home.php#login");
  }
 ?>
