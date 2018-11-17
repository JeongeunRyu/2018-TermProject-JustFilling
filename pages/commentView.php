<?php
 require_once ("BoardDao.php");
$num = requestValue("num");
$page = requestValue("page");
 $dao = new BoardDAO();


$txt=$dao->getCmt($num);



?>
<script>
    function processDelete(num) {
        result = confirm("삭제하시겠습니까?");
        if(result) {
            location.href="delete.php?num="+num;
        }
    }
</script>
    <div class="mx-5 mb-5 ">
        <?php foreach($txt as $msg) :
        ?>
        <div class="row mb-2">
            <div class="col-1 cmt" style="background-color: #6c6783;color: white;font-weight: bold">
                <?= $msg["cwriter"] ?>
            </div>
            <div class="col-8 cmt">
                <?= $msg["ctext"] ?>
            </div>
            <div class="col-2 cmt">
                <?=  $msg["regtime"] ?>
            </div>
            <div class="col-1 cmt">
                <a href="#">X</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


