<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>member_join</title>
  </head>
  <body>
    <?php
    require_once("tools.php");
    require_once("MemberDao.php");
      //request로부터 id 값 읽어 오기
      $id=requestValue("id");
      //request로부터 pw 값 읽어 오기
      $pw=requestValue("pw");
      //request로부터 name 값 읽어 오기
      $name=requestValue("name");
      //request로부터 mobile 값 읽어 오기
      $mobile=requestValue("mobile");
      //request로부터 grade 값 읽어 오기
      $grade=requestValue("grade");

      //모든 입력란이 채워져 있고, 사용 중인 아이디가 아니라면
      //회원 정보 추가.
        $mdao = new MemberDao();
        if($id && $pw && $name && $mobile && $grade){
          if($mdao->getMember($id)){
          //중복아이디인 경우 에러 메세지 출력 후 회원가입 페이지로 이동
        errorBack("이미 사용중인 아이디 입니다.");
          exit();
          }else {
          // 데이터베이스에 회원정보 insert
          // 가입이 완료 되었다는 메세지 출력 후 메인 페이지 이동
          $mdao->insertMember($id,$pw,$name,$mobile,$grade);
          okGo("가입이 완료되었습니다.",MAIN_PAGE);
        }
      }else{
        //공란이 있을경우 에러 메세지 출력 후 회원가입 페이지로 이동
        errorBack("모든 입력란을 채워 주세요.");
      }
     ?>
  </body>
</html>
