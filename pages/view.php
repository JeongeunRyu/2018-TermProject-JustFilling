<?php
/*
    1. 클리어언트로부터 전송되어오 num 값을 추출
    2. 그 num 값으로 DB에서 게시글 레코드를 읽고
    3. 그 읽은 레코드를 이용해서
       게시글 상세정보를 html로 만든다.
*/


require_once("tools.php");
require_once("BoardDao.php");

session_start_if_none();


$nowBoard = sessionVar("nowBoard");
$num = requestValue("num");
$page = requestValue("page");

$dao = new BoardDao();
if($nowBoard == "board"){
    $dao->increaseHits("jfboard",$num);
    $msg = $dao->getMsg("jfboard",$num);
}else if($nowBoard == "board2"){
    $dao->increaseHits("jfboard2",$num);
    $msg = $dao->getMsg("jfboard2",$num);
}


?>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <?php require_once ("htmlHead.php");
    ?>
    <script>
        function processDelete(num) {
            result = confirm("삭제하시겠습니까?");
            if(result) {
                location.href="delete.php?num="+num;
            }
        }
    </script>

    <style>
        table{

            margin: 2%;

        }
        th{
            text-align: center;
        }
        .butt{
            margin-left: 45%;

        }
        .content{
            margin-bottom: 2.5%;
        }
    </style>
</head>
<body >

<?php
require_once ("nav.php");





?>
<div class="content">
<table class="table col-8 mx-auto">
    <tr>
        <th>제목</th>
        <td><?=$msg["title"] ?></td>
    </tr>
    <tr>
        <th>작성자</th>
        <td><?=$msg["writer"] ?></td>
    </tr>
    <tr>
        <th>작성일자</th>
        <td><?=$msg["regtime"] ?></td>
    </tr>
    <tr>
        <th>조회수</th>
        <td><?=$msg["hits"] ?></td>
    </tr>
    <tr>
        <th>내용</th>
        <td><?=$msg["content"] ?></td>
    </tr>
</table>


<span class="butt">
<button onclick="location.href='<?= bdUrl($nowBoard.".php",0,$page) ?>'" type="button" class="btn btn-primary">목록보기</button>
<?php


$loginFlag=isLogin(); //세션의 로그인 정보와 writer의 로그인 정보 확인
$myArticle=isMyArticle($msg["writer"]); //로그인한 사용자의 아이디와 글 작성자의 아이디 비교

if($loginFlag && $myArticle){?>

    <button onclick="location.href='modifyForm.php?num=<?= $msg["num"]?> &page=<?= $page ?>'" class="btn btn-warning">수정</button>
    <button type="submit"
            onclick="processDelete(<?= $msg["num"] ?>)"
            class="btn btn-danger">삭제하기</button>
    <?php
}
?>
</span>

</div>
<hr>
<div>
    <?php
    require_once("commentForm.php");
    require_once ("commentView.php");
    ?>
</div>
<?php
require_once ("footer.php");
?>

</body>
</html>