<html>
  <head>

      <?php require_once ("htmlHead.php"); ?>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Nanum+Myeongjo');
    body{ background-image:url("../media/join.jpg");
    background-repeat:no-repeat;
    background-position:center;
    background-size:cover;
  		text-align: center;
  		background-color: #DBC5DB;

  		font-family: 'Nanum Myeongjo', serif;
  		font-weight: bold;

  	}
    .container{
        padding: 2%;
    }
    h1{
      font-family: 'Nanum Myeongjo', serif;
      letter-spacing: 0.25em;
    }

  	::-moz-selection {
  			color: white;
  			background: #7A5C99;
  	}

  	::selection {
  			color: white;
  			background: #7A5C99;
  	}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.form-control:focus {
    border-color: #EAEAEA;
    background-color: #F5F2FA;
}
.main-div {
background-color: rgba(255, 255, 255, 0.8);
border-radius: 20px;
margin: 1.2% auto ;
max-width: 50%;
padding: 4%;
}

.login-form .form-control , .btn {

min-height: 4%;
border-radius: 30px;
    font-size: 0.8em;
    transition: all 0.5s;
}
.login-form .form-control {

}
.login-form{ text-align:center;}

.login-form  .btn{
  background: #8F6BB3;
  border: none;
  line-height: normal;
}

    </style>
  </head>
<body>
<?php require_once ("nav.php"); ?>
<div class="container">
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h1>회원가입</h1>
   <p>하기의 정보를 작성해 주세요.</p>
   </div>
<form action="join.php" method="post">
   <div class="form-group row">
  <label for="id" class="col-sm-4 col-form-label">아이디</label>
  <div class="col">
  <input type="text" id="id" class="form-control" name="id" placeholder="ID" required="required">
</div>
   </div>
   <div class="form-group row">
   <label for="pw" class="col-sm-4 col-form-label">비밀번호</label>
   <div class="col">
   <input type="password" id="pw" class="form-control" name="pw" placeholder="PASSWORD" required="required">
   </div>
   </div>
   <div class="form-group row">
   <label for="pw" class="col-sm-4 col-form-label">이름</label>
   <div class="col">
   <input type="text" id="name" class="form-control" name="name" placeholder="NAME" required="required">
   </div>
   </div>
   <div class="form-group row">
   <label for="pw" class="col-sm-4 col-form-label">전화번호</label>
   <div class="col">
   <input type="tel" id="mobile" class="form-control" name="mobile" placeholder="PHONE NUMBER" required="required">
   </div>
   </div>
   <div class="form-group row">
   <label for="grade" class="col-sm-4 col-form-label">회원구분</label>
   <div class="col">
     <div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="normal" name="grade" class="custom-control-input" value="normal">
  <label class="custom-control-label" for="normal">일반회원</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="shop" name="grade" class="custom-control-input" value="shop">
  <label class="custom-control-label" for="shop">마카롱가게</label>
</div>
   </div>
   </div>

   <button type="submit" class="btn btn-primary">가입하기</button>
   <input type="reset" class="btn btn-primary" value="다시쓰기">
     </form>
   </div>
    </div>
</div></div>
 <script src="../js/main.js" charset="utf-8"></script>
<?php require_once ("footer.php"); ?>
</body>
</html>
