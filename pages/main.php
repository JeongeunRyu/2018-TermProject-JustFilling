<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/journal/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<style>
	@import url('https://fonts.googleapis.com/css?family=Nanum+Myeongjo');

	body{
		text-align: center;
		background-color: #DBC5DB;
		overflow: hidden;
		font-family: 'Nanum Myeongjo', serif;
		font-weight: bold;
        z-index: -1;
	}


	::-moz-selection {
			color: white;
			background: #7A5C99;
	}

	::selection {
			color: white;
			background: #7A5C99;
	}

	.player audio::-webkit-media-controls-panel
	{
		background-color: #875f99;
		-webkit-filter: opacity(50%);filter: opacity(50%);
	}

	.fa-store,.fa-user{
		color: #505050;
	}

	////////////////////////////////

	</style>
</head>


 <body>
 <?php
 require_once ("nav.php");
 ?>
 	<?php
 		//term-project main page
 	 ?>
    <h1>두번째 페이지다.</h1>



    <div class="player">
   <audio controls autoplay controlsList="nodownload">
     <source src="../media/bg.mp3">
   </audio>
 		</div>


 <?php
    require_once("tools.php");
    //지정된 파일을 이 코드가 있던 자리에 넣어줌
    //(앞에서 이 파일을 읽었다면 미수행)
    //세션 상태 확인 후, session_start()실행 및 지정된 세션변수 값 읽어 반환
    readSessionVar("uid");
    //사용자 아이디와 이름 - 변수 $id, $name에 넣음.
    $id = sessionVar("uid");
    $name = sessionVar("uname");
    $grade = sessionVar("ugrade");
    $normal="일반";
    $shop="가게";
    //로그인 여부 판단
    //로그인 상태
    if($id) :
			if($grade=="normal"){
				?>
				<i class="far fa-user"></i>
				<?php
				$grade=$normal;
			}elseif ($grade=="shop") {
				?>
				<i class="fas fa-store"></i>
				<?php
				$grade=$shop;
			}
			echo "<h3>", $name ,"님 환영합니다. ";
			echo $grade,"회원입니다.</h3>";
			?>
      <input type="button" class="btn btn-primary" value="회원정보 수정" onclick="location.href='updateForm.php'">
      <input type="button" class="btn btn-primary" value="로그아웃" onclick="location.href='logout.php'">
      <?php
     //미로그인 상태
    else : ?> <h3>로그인이나 회원가입을 해주세요 ^^!</h3>

   <input type="button" class="btn btn-primary" value="회원가입" onclick="location.href='joinForm.php'">
	 <div class="text-center">
	 	<a href="#loginModal" class="trigger-btn" data-toggle="modal"><input type="button" class="btn btn-primary" value="로그인"></a>
	 </div>

	 <div id="loginModal" class="modal fade">
	 	<?php
		include('loginForm.php');
		 ?>
	 </div>
   <?php endif ?>



	 <script src="../js/main.js" charset="utf-8"></script>
	 <script>
	 	var hash = location.hash;

		if(hash == '#login'){
			document.getElementsByClassName('trigger-btn')[0].click();
		}
	 </script>


 <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
 <div class="dropdown-menu col-3">
     <?php
     require_once("tools.php");
     //지정된 파일을 이 코드가 있던 자리에 넣어줌
     //(앞에서 이 파일을 읽었다면 미수행)

     //세션 상태 확인 후, session_start()실행 및 지정된 세션변수 값 읽어 반환
     readSessionVar("uid");

     //사용자 아이디와 이름 - 변수 $id, $name에 넣음.
     $id = sessionVar("uid");
     $name = sessionVar("uname");
     $grade = sessionVar("ugrade");
     $normal="일반";
     $shop="가게";

     //로그인 여부 판단
     //로그인 상태
     if($id) :?>

         <a class="dropdown-item" href="logout.php">로그아웃</a>
         <a class="dropdown-item" href="updateForm.php">회원정보수정</a>
         <?php

         if($grade=="normal"){
             ?>
             <i class="far fa-user"></i>

             <?php
             $grade=$normal;

         }elseif ($grade=="shop") {
             ?>
             <i class="fas fa-store"></i>

             <?php
             $grade=$shop;

         }
         ?>
         <div><?=$name?>님 안녕하세요.<?=$grade?>회원입니다.</div>




     <?php
     //미로그인 상태
     else : ?>


     <a class="dropdown-item" class="trigger-btn" data-toggle="modal" href="#loginModal">로그인</a>
     <a a class="dropdown-item" href="joinForm.php">회원가입</a>
 </div>
     </li>


     <div id="loginModal" class="modal fade">
         <?php
         include('loginForm.php');
         ?>
     </div>
 <?php endif ?>




 </ul>
 </div>
 </body>
</html>
