<?php
class MemberDAO {
	private $db;

	public function __construct() {
		try {
			$this->db = new PDO("mysql:host=localhost;dbname=php", "root", "1111");

			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		}catch(PDOException $e) {
			exit($e->getMessage());
		}
	}

	public function getMember($id) {
		try {
			// place holder
			$sql = "select * from member where id = :id";
			/* 준비하다. 실행준비, DB서버가 ...
			  1. 문법검사 
			  2. 유효성검사 
			  3. 실행계획 수립 
			  */
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
			$pstmt->execute();
			$result = $pstmt->fetch(PDO::FETCH_ASSOC);

		}catch(PDOException $e) {
			exit($e->getMessage());
		}

		return $result;
	}

	public function insertMember($id, $pw, $name) {
		try {
			$sql = "insert into member(name, pw, id) values(:name, :pw, :id)";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
			$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
			$pstmt->bindValue(":pw", $pw, PDO::PARAM_STR);

			$pstmt->execute();
		}catch(PDOException $e) {
			exit($e->getMessage());
		}

	}


	function updateMember($id, $pw, $name) {
		try {
			$sql = "update member set pw = :pw, name=:name where id=:id";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":pw", $pw, PDO::PARAM_STR);
			$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
			$pstmt->bindValue(":id", $id, PDO::PARAM_STR);

			$pstmt->execute();

		}catch(PDOException $e) {
			exit($e->getMessage());
		}

	}

}

?>