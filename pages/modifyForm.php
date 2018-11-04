<!DOCTYPE html>
<html>
<head>
    <?php
    require_once ("htmlHead.php");
    ?>
    <script src="ckeditor/ckeditor.js"></script>
    <style>
        .butt{
            margin-left: 45%;
        }
        th{
            width: 15%;
        }
    </style>
</head>
<body>
<?php
/*
    1. 클리어언트로부터 전송되어오 num 값을 추출
    2. 그 num 값으로 DB에서 게시글 레코드를 읽고
    3. 그 읽은 레코드를 이용해서
       게시글 상세정보를 html로 만든다.
*/
require_once ("nav.php");
require_once("tools.php");
require_once("BoardDao.php");
require_once("memberDao.php");
session_start_if_none();
$nowBoard = sessionVar("nowBoard");

$num = requestValue("num");
$page = requestValue("page");
$dao = new BoardDao();

if($nowBoard == "board1"){
    $msg=$dao->getMsg("jfboard",$num);
}else if($nowBoard == "board2"){
    $msg=$dao->getMsg("jfboard2",$num);
}



$uid=$_SESSION["uid"];
$uname=$_SESSION["uname"];
/*uid로 데이터 베이스에 질의 - 이 아이디를 가진 회원 정보를 가져올 것*/
$mdao=new MemberDao();
$member=$mdao->getMember($uid);
if(!$member){
errorBack("로그인 해주세요.");
exit();

}

isMyArticle($msg["writer"]); //로그인한 사용자의 아이디와 글 작성자의 아이디 비교



if($uid != $member["id"]){
    errorBack("본인 글이 아닙니다.");
    }

?>
<div><h1>수정폼</h1></div>

<form class="mx-auto" action="modify.php?num=<?= $msg["num"] ?>" method="post">
    <div>
        <table class="table col-8 mx-auto">
            <tr>
                <th><label for="title">제목</label></th>
                <td><input type="text" id="title" name="title" class="form-control" value="<?=$msg["title"] ?>" required></td>
            </tr>
            <tr>
                <th>작성자</th>
                <td><input type="text" class="form-control-plaintext" id="writer" name="writer" value="<?=$msg["writer"] ?>" readonly></td>
            </tr>
            <tr>
                <th><label for="editor1">내용</label></th>
                <td><textarea name="content" id="editor1"  cols="80" class="form-control" >
                        <?=$msg["content"] ?>
                    </textarea></td>
            </tr>
        </table>


        <span class="butt">
        <button type="submit" class="btn btn-warning">글수정</button>
        <button onclick="location.href='board.php?page=<?= $page ?>'" type="button" class="btn btn-primary">목록보기</button>
    </span>
    </div>

</form>
<?php
require_once ("footer.php");
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl7Z3CoJWfpaxozbZXVtr21GENo5WfwUs">/*사용자 인증 번호*/</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1', {
    });

    CKEDITOR.on('dialogDefinition', function (ev) {

        var dialogName = ev.data.name;

        var dialog = ev.data.definition.dialog;

        var dialogDefinition = ev.data.definition;

        if (dialogName == 'image') {

            dialog.on('show', function (obj) {

                this.selectPage('Upload'); //업로드텝으로 시작

            });

            dialogDefinition.removeContents('advanced'); // 자세히탭 제거
            dialogDefinition.removeContents('Link'); // 링크탭 제거

        }

    });


</script>
</body>
</html>
