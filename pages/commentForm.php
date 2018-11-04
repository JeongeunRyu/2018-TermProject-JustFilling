<?php

require_once ("memberDao.php");

$loginFlag = isLogin();
if($loginFlag){

$uid=$_SESSION["uid"];
$mdao=new MemberDAO();
$member=$mdao->getMember($uid);

    $num = requestValue("num");
    $page = requestValue("page");

?>
<div class="mx-5 mb-5">
    <form action="commentWrite.php?num=<?=$num?>&page=<?=$page?>" method="post" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control-plaintext" id="writer" name="writer" value="<?= $member["name"] ?>" readonly>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="comment" cols="80" rows="2"></textarea>

            <a href="view.php?num=<?=$num?>&page=<?=$page?>"><input type="submit" class="btn btn-primary ml-3" value="덧글등록"></a>
        </div>
     </form>
</div>
<?php
}else{
    echo "로그인 해주세요";
}
?>
