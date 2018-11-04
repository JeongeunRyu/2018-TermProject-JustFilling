<?php
	/*
		request 정보에서 id, pw, name 추출
		데이터베이스에서 저장된 회원정보 수정
		main 페이지로 이동
	*/

	require_once("tools.php");	
	require_once("MemberDao.php");
	session_start();

	$id = requestValue("id");
	$pw = requestValue("pw");
	$name = requestValue("name");

	/* 1. 로그인 한 사용자인지 check
	   2. 로그인한 사용자 본인의 회원정보를 수정하려는 것인지 check
	 */

	 $suid = isset($_SESSION["uid"])?$_SESSION["uid"]:"";
	 if(!$suid) { // 로그인 하지 않은 경우
	 	errorBack("로그인부터 해라! 이씨~");	 	
	 }else {
	 	if($suid != $id)
	 		errorBack("니 정보 아이다 새끼야~");
	 }

	if ($id && $pw && $name) {
		$mdao = new MemberDao();
		$mdao->updateMember($id, $pw, $name);
		$_SESSION["name"] = $name;

		okGo("회원정보가 수정되었습니다.", MAIN_PAGE);

	} else {
		errorBack("모든 입력란을 채워주세요...");
	}

?>