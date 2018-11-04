<?php
 require_once ("BoardDao.php");
$num = requestValue("num");
$page = requestValue("page");
 $dao = new BoardDAO();


$txt=$dao->getCmt($num);



?>

    <div class="mx-5 mb-5">
        <?php foreach($txt as $msg) :
        ?>
        <div class="form-inline">
            <div class="form-group mr-5 cmt">
                <?= $msg["cwriter"] ?>
            </div>
            <div class="form-group mr-5 cmt">
                <?= $msg["ctext"] ?>
            </div>
            <div class="form-group mr-5 cmt">
                <?=  $msg["regtime"] ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


