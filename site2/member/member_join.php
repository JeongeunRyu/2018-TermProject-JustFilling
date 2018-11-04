<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		require_once("tools.php");
		require_once("MemberDao.php");

		// request로부터 id 값 읽어 오기
		//$id = isset($_REQUEST["id"])?$_REQUEST["id"]:"";
		$id = requestValue("id");
		// request로부터 pw 값 읽어 오기
		$pw = requestValue("pw");
		// request로부터 name 값 읽어 오기
		$name = requestValue("name");

		// 모든 입력란이 채워져 있고, 사용 중인 아이디가 아니라면 회원정보 추가
		if($id && $pw && $name) {
			$mdao = new MemberDAO();
			if ($mdao->getMember($id)) {
				//에러 메시지 출력 후 회원가입 페이지로 이동
				// Javascript 코드로 Web browser에게 전송할꺼임. 
				/*
				echo"<script>
					alert('이미 사용중인 아이디 입니다.');
					location.href = 'member_join_form.php'; 
				</script> ";

				*/
				 errorBack('이미 사용중인 아이디 입니다.');
				
				exit();
			} else {
				$mdao->insertMember($id, $pw, $name);
				okGo("가입이 완료 되었습니다.", MAIN_PAGE);
				/*
				데이터베이스 회원정보 insert 
				"가입이 완료 되었습니다" 라는 메시지 출력 후, 메인 페이지 이동				
				*/
			}
		}

	?>
</body>
</html>