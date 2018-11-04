<?php
function bdURL($file,$num,$page){
    $join="?";
    if ($num) {
        $file .= $join . "num=$num";
        $join="&";
    }
    if($page)
        $file .= $join."page=$page";

    return $file;
}

//로그인, 로그아웃, 회원 가입, 회원 정보 수정 처리 후, 지정된 페이지로 돌아감
define("MAIN_PAGE","home.php");
//define(상수 명, 상수 값);
//상수는 앞에 $ 붙지 않음, 관례적으로 대문자 사용.


//GET/POST로 전달된 값을 읽어 반환(해당 변수 존재 여부부터 확인)
//해당 값 미정의시 빈 문자열 반환
  function requestValue($var){
    return isset($_REQUEST[$var])?$_REQUEST[$var]:"";
  }

//세션변수 값 읽어 반환
//해당 값 미정의시 빈 문자열 반환
 function sessionVar($var){
   return isset($_SESSION[$var])?$_SESSION[$var]:"";
 }

//경고창에 오류 메시지 출력, 이전 페이지로 돌아감
  function errorBack($msg){
    ?>
    <script>
      alert('<?= $msg ?>');
      history.back();
    </script>
    <?php
    exit();
  }

//경고창에 지정된 메세지 출력, 지정된 페이지로 이동
  function okGo($msg,$url){
    ?>
    <script>
      alert('<?= $msg ?>');
      location.href='<?= $url ?>';

    </script>
    <?php
    exit();
  }

//지시된 URL로 이동
  function goNow($url){
    ?>
    <script>
      location.href='<?= $url ?>';
    </script>
    <?php
    exit();
  }


 function session_start_if_none(){
   if(session_status() == PHP_SESSION_NONE){
     session_start();
   }
 }

  //세션이 시작되지 않았으면 start_session()실행,
  //지정된 세션변수 값을 읽어 반환
  //이 함수가 있으면 다른 프로그램에서 따로 session_start_if_none()을 부르지 않아도 됨.
  function readSessionVar($var){
    //세션변수명을 매개변수로 받음.
    if(session_status() == PHP_SESSION_NONE){
      //세션이 시작 되지 않았으면 start_session()실행
        session_start();
    //세션변수값 읽어서 반환, 미 정의시 공란 반환
    isset($_SESSION[$var])?$_SESSION[$var]:"";
  }
  }

function isLogin(){
    return isset($_SESSION["uid"]);
}
function isMyArticle($writer){
    if (isset($_SESSION["uname"])) {
        return $writer == $_SESSION["uname"];
    }else{
        return false;
    }
}

 ?>
