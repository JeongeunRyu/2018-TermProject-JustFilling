<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
        $(function (){/*jquery의 onload함수. 페이지가 그려지고 난 후에 실행 */
            $('.summernote').summernote({
                height:350,
                minHeight:null,
                maxHeight:null,
                focus:true,
                placeholder: "testMessage",
                callbacks:{onImageUpload:function(image){
                        editor=$(this);
                        uploadImageContent(image[0],editor);
                    }}
            });
            function uploadImageContent(image,editor){
                var data = new FormData();
                data.append("image",image);
                $.ajax({
                    data:data,
                    type:"post",
                    url:"./image_upload.php",
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function(url){
                        var image = $('<img>').attr('src',url);
                        $(editor).summernote("insertNode",image[0]);

                    },
                    error:function(data){
                        console.log(data);
                    }

                });
            }
        });
    </script>
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
                <td><textarea name="content" id="editor1" rows="10" cols="80" class="form-control summernote" ></textarea></td>
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

</body>
</html>
