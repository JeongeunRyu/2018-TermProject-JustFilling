<?php

	require_once("../tools.php");
	require_once("MemberDao.php");

	session_start();

/*
	인증 (Authentication) vs. 권한관리(Authorization)

	request에서 id, pw 추출
	DB에서 그 id와 pw 가진 레코드 있는지 확인하고 
	  (select * from member where id = :id and pw = :pw)
	 
	 => id와 pw 값을 가지고 select  해도 되지만 
	   : select * from member where id = $id and pw =$pw;
	 => 일반적으로 id값만 가지고 select 해본다.
	   : select * from member where id = $id

	있으면 session에 로그인 했음을 표시하는 정보 기록하고
	main page로 이동
*/
	$id = requestValue("id");
	$pw = requestValue("pw");

	$mdao = new MemberDao();
	$member = $mdao->getMember($id);

	if($member && $member["pw"] == $pw) {
		// 로그인 성공
		// 세센에 로그인 성공 정보를 기록 : 어떻게?
		$_SESSION["uid"] = $id;
		$_SESSION["name"] = $member["name"];
		goNow(MAIN_PAGE);
	} else {
		// 로그인 실패 	
		errorBack("로그인 실패");
	}







?>









