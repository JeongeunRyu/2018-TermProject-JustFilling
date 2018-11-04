<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">회원관리</a>
<div class="dropdown-menu dropdown-menu-right">
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
$loginFlag=isLogin(); //세션의 로그인 정보와 writer의 로그인 정보 확인
//로그인 여부 판단
//로그인 상태
if($loginFlag):?>

    <a class="dropdown-item" href="logout.php">로그아웃</a>
    <a class="dropdown-item" href="updateForm.php">회원정보수정</a>
    </div>
    </ul>
    <span class="navbar-text text-white">
                <?php
                if($grade=="normal"){
                    ?>
                    <span class="far fa-user"></span>
                    <?php
                    $grade=$normal;
                }elseif ($grade=="shop") {
                    ?>
                    <span class="fas fa-store"></span>
                    <?php
                    $grade=$shop;
                }
                ?>
        <?=$name?>님 안녕하세요. <?=$grade?>회원입니다.
        </span>
<?php
//미로그인 상태
else : ?>
    <a class="dropdown-text">
        <?php require_once ("loginForm.php"); ?>
    </a>
    <div class="dropdown-divider"></div>
    <a a class="dropdown-item" href="joinForm.php">회원가입</a>
    </div>
    </ul>
    <span class="navbar-text">
        로그인이나 회원가입 해주세요.
    </span>


<?php

endif ?>



