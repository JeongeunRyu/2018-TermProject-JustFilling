<!DOCTYPE html>
<html>
<head>
    <?php require_once ("htmlHead.php");
    ?>
</head>
<body>
<?php
require_once("BoardDao.php");
require_once("tools.php");
$grade=sessionVar("ugrade");
$page = requestValue("page"); //현재 페이지 번호(링크)

define("NUM_LINES", 5);	// 한페이지당 게시글 갯 수
define("NUM_PAGE_LINKS", 3); //화면에 표시 될 페이지 링크 수

session_start();
$nowBoard=$_SESSION["nowBoard"] = "board";
$board = "jfboard";
//게시판의 전체 게시글 수
$dao = new BoardDao();
$numMsgs = $dao->getNumMsgs($board); //전체 게시글 갯 수
if ($numMsgs >0) {
    //전체 페이지 수 구하기
    $numPages = ceil($numMsgs / NUM_LINES);

    //현재 페이지 번호가 (1~전체 페이지 수를 벗어나면 보정

    if($page<1)
        $page = 1;
    if($page>$numPages)
        $page = $numPages;

    //리스트에 보일 게시글 데이터 읽기
    $start = ($page-1)*NUM_LINES; //첫줄의 레코드 번호



    $msgs = $dao->getManyMsgs($board,$start,NUM_LINES);

    //페이지네이션 컨트롤의 처음 / 마지막 페이지 링크번호 계산
    $firstPage=floor(($page-1)/NUM_PAGE_LINKS)*NUM_PAGE_LINKS+1;
    $lastPage=$firstPage+NUM_PAGE_LINKS-1;

    if ($lastPage>$numPages)
        $lastPage = $numPages;
}
require_once ("nav.php");
?>
<h1 style="text-align: center">회원 게시판</h1>

<div class="container">
    <?php if($numMsgs>0) :?>
        <table class="table table-hover">
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
                <th>조회수</th>
            </tr>

            <?php foreach($msgs as $msg) : ?>
                <tr>
                    <td><?= $msg["num"] ?> </td>
                    <td><b><a href="<?= bdUrl("view.php",$msg["num"],$page=$page); $nowBoard?>"><?= $msg["title"] ?> </a> </b></td>
                    <td>
                        <?= $msg["writer"] ?> </td>
                    <td><?=substr( $msg["regtime"], 0, 11)  ?> </td>
                    <td><?= $msg["hits"] ?> </td>
                </tr>
            <?php endforeach ?>


        </table>

        <br>
    <span class>
        <ul class="pagination justify-content-center">

        <?php if($firstPage>=1) :?>
            <li class="page-item">
                <a class="page-link" href="<?= bdUrl("board.php",0,$firstPage-NUM_PAGE_LINKS)?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>


        <?php endif ?>

        <?php for($i = $firstPage; $i<=$lastPage;$i++) :?>
            <?php if($i==$page) :?>
                <li class="page-item"><a class="page-link bg-primary text-white" href="<?= bdUrl("board.php",0,$i)?>"><b><?= $i ?></b></a></li>

            <?php else : ?>
                <li class="page-item"><a class="page-link" href="<?= bdUrl("board.php",0,$i)?>"><?= $i ?></a></li>
            <?php endif ?>
        <?php endfor ?>


        <?php if($lastPage<=$numPages): ?>
            <li class="page-item">
                <a class="page-link" href="<?= bdUrl("board.php",0,$firstPage+NUM_PAGE_LINKS)?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            </ul>
        <?php endif ?>
    <?php endif ?>

        <span class="float-right mb-5 mr-5">
        <?php
        $loginFlag=isLogin();
        if($loginFlag){?>
        <button class="btn btn-primary" onclick="location.href='writeForm.php'">글쓰기</button>
        <?php
        }
        else{
        ?>
        <p>회원만 글을 작성할 수 있습니다.</p>

</span>
    <?php
    }
    ?>
        <span class="float-right mb-5 mr-5">

</span>
</span>
</div>
<?php
require_once ("footer.php");
?>
</body>
</html>