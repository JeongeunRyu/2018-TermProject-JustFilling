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
require_once ("nav.php");
require_once ("memberDao.php");
require_once ("tools.php");

/*로그인 안 한 사람은 글 못봄*/
session_start_if_none();
$uid=$_SESSION["uid"];
/*uid로 데이터 베이스에 질의 - 이 아이디를 가진 회원 정보를 가져올 것*/
$mdao=new MemberDAO();
$member=$mdao->getMember($uid);
if(!$member){
    errorBack("로그인 해주세요.");
    exit();
}

?>
<div><h1>작성폼</h1></div>
<form class="mx-auto" action="write.php" method="post">
    <div>
    <table class="table col-8 mx-auto">
        <tr>
            <th><label for="title">제목</label></th>
            <td><input type="text" id="title" name="title" class="form-control" required></td>
        </tr>
        <tr>
            <th>작성자</th>
            <td><input type="text" class="form-control-plaintext" id="writer" name="writer" value="<?= $member["name"] ?>" readonly></td>
        </tr>
        <tr>
            <th><label for="editor1">내용</label></th>
            <td><textarea name="content" id="editor1"  cols="80" class="form-control" ><form action="book.php">
</textarea></td>
        </tr>
    </table>


    <span class="butt">
        <button type="submit" class="btn btn-primary">글등록</button>
        <button onclick="location.href='board.php'" class="btn btn-danger">목록보기</button>
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
