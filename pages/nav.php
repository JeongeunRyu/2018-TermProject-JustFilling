<nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-top mb-auto">
    <a class="navbar-brand pl-2" href="/201802/term/index.php">
        <img src="/201802/term/media/jflogo.png" width="120" height="40" class="d-inline-block align-top" alt="JustFilling">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/201802/term/pages/home.php">홈</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/201802/term/pages/board.php">회원 게시판</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/201802/term/pages/board2.php">가게 게시판</a>
            </li>
            <li class="nav-item dropdown" id="forClick">
                    <?php
                    require_once ("loginCheck.php");
                    ?>
    </div>


</nav>