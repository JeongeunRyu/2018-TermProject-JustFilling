<!DOCTYPE html>
<html>
<head>
    <?php require_once ("htmlHead.php");
    ?>
    <script>
        function searchBtn() {
            var searchValue = document.getElementById('inputState').value;
            var search = document.getElementById('inputText').value;

            var url = '/201802/term/pages/board.php?search=' + search +'&searchChoice=' + searchValue;
            location.href=url;

        }
    </script>
</head>
<body>
<?php
require_once("BoardDao.php");
require_once("tools.php");
session_start();
$nowBoard=$_SESSION["nowBoard"] = "board";
$board = "jfboard";
//게시판의 전체 게시글 수


$search=requestValue("search");
$searchChoice=requestValue("searchChoice");


$grade=sessionVar("ugrade");


$page = requestValue("page"); //현재 페이지 번호(링크)

$dao = new BoardDao();
$numMsgs = $dao->getNumMsgs($board); //전체 게시글 갯 수


define("NUM_LINES", 5);	// 한페이지당 게시글 갯 수
define("NUM_PAGE_LINKS", 3); //화면에 표시 될 페이지 링크 수

if($page<1){
    $page = 1;
}
$firstPage=floor(($page-1)/NUM_PAGE_LINKS)*NUM_PAGE_LINKS+1;
$lastPage=$firstPage+NUM_PAGE_LINKS-1;

//리스트에 보일 게시글 데이터 읽기
$start = ($page-1)*NUM_LINES; //첫줄의 레코드 번호

$msgs = $dao->getManyMsgs($board,$start,NUM_LINES);


if($search){
    switch($searchChoice){
        case "title":
            $search = requestValue("search");
            $numMsgs = $dao->getSearchTitleMsgs($search);  //토탈 레코드 저장 갯수
            $msgs = $dao-> searchTitleMsg($search,$start,NUM_LINES); //내용
            break;
        case "writer" :
            $search = requestValue("search");
            $numMsgs = $dao->getSearchWriterMsgs($search);  //토탈 레코드 저장
            $msgs = $dao-> searchWriterMsg($search,$start,NUM_LINES);
            break;

        case "content" :
            $search = requestValue("search");
            $numMsgs = $dao->getSearchContentMsgs($search);  //토탈 레코드 저장
            $msgs = $dao-> searchContentMsg($search,$start,NUM_LINES);
            break;
        case "titleAndcotent" :
            $search = requestValue("search");
            $numMsgs= $dao->getsearchTitleAndContentMsg($search);  //토탈 레코드 저장
            $msgs = $dao-> searchTitleAndContentMsg($search,$start,NUM_LINES);
            break;
    }


    ?>

<?php
}







if ($numMsgs >0) {
    //전체 페이지 수 구하기
    $numPages = ceil($numMsgs / NUM_LINES);

    //현재 페이지 번호가 (1~전체 페이지 수를 벗어나면 보정

    if($page>$numPages)
        $page = $numPages;


    //페이지네이션 컨트롤의 처음 / 마지막 페이지 링크번호 계산

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
                    <td><b><a href="<?= bdUrl("view.php",$msg["num"],$page=$page,$searchChoice,$search); $nowBoard?>"><?= $msg["title"] ?> </a> </b></td>
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
                <a class="page-link" href="<?= bdUrl("board.php",0,$firstPage-NUM_PAGE_LINKS, $searchChoice,$search)?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>


        <?php endif ?>

        <?php for($i = $firstPage; $i<=$lastPage;$i++) :?>
            <?php if($i==$page) :?>
                <li class="page-item"><a class="page-link bg-primary text-white" href="<?= bdUrl("board.php",0,$i, $searchChoice,$search)?>"><b><?= $i ?></b></a></li>

            <?php else : ?>
                <li class="page-item"><a class="page-link" href="<?= bdUrl("board.php",0,$i, $searchChoice,$search)?>"><?= $i ?></a></li>
            <?php endif ?>
        <?php endfor ?>


        <?php if($lastPage<$numPages): ?>
            <li class="page-item">
                <a class="page-link" href="<?= bdUrl("board.php",0,$firstPage+NUM_PAGE_LINKS, $searchChoice,$search)?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>

        <?php endif ?>
            </ul>


    <?php endif ?>

        <span class="float-left mb-5 mr-5">
            <div class="form-inline">
                <div class="form-group row mr-5">
                    <select id="inputState" class="form-control" name="searchChoice" required>
                            <option selected value="title">제목</option>
                            <option value="writer">글쓴이</option>
                            <option value="content">내용</option>
                            <option value="titleAndcotent">제목+내용</option>
                        </select>
                </div>
                <div class="form-group row mr-5">
                <input type="text" id="inputText" name="search" class="form-control row">
                    </div>
                <div class="form-group row">
                <input type="submit" class="btn btn-primary row" onclick="searchBtn()" value="검색">
                </div>
                </div>
        </span>
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

</div>

<?php
if ($searchChoice && $search){
    ?>
    <div class=" mb-5 mr-5">


        <button onclick="location.href='<?= bdUrl($nowBoard.".php",0,$page,0,0) ?>'" type="button" class="btn btn-secondary">목록으로 돌아가기</button>
    </div>
    <?php
}
?>


<?php
require_once ("footer.php");
?>
</body>
</html>