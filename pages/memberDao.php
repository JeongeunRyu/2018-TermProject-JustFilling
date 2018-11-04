<?php
class MemberDAO{
  private $db; //PDO객체 저장하기 위한 프로퍼티

//DB에 접속, PDO객체 $db에 저장
  public function __construct(){
    try {
      $this->db = new PDO("mysql:host=localhost;dbname=php","root","1111");
      $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

//아이디가 $id인 레코드 반환
//지정된 아이디 가진 회원의 회원정보 읽어올 때 사용
  public function getMember($id){
    try {
      $query=$this->db->prepare("select * from jfmember where id = :id");
      /*실행 준비 , DB서버가
      1. 분법검사
      2. 유효성 검사
      3. 실행계획 수립*/
      $query->bindValue(":id",$id,PDO::PARAM_STR);
      $query->execute();

      $result=$query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
    return $result;
  }

//회원 정보 추가(새로운 회원정보 저장 - insert 쿼리 실행 )
  public function insertMember($id, $pw, $name, $mobile, $grade){
    try{

      $query=$this->db->prepare("insert into jfmember values(:id,:pw,:name,:mobile,:grade)");
      $query->bindValue(":id",$id,PDO::PARAM_STR);
      $query->bindValue(":pw",$pw,PDO::PARAM_STR);
      $query->bindValue(":name",$name,PDO::PARAM_STR);
      $query->bindValue(":mobile",$mobile,PDO::PARAM_STR);
      $query->bindValue(":grade",$grade,PDO::PARAM_STR);
      $query->execute();

    }catch (PDOException $e) {
      exit($e->getMessage());
    }
  }

//아이디가 $id인 회원 정보 업데이트( 회원정보 수정 - update 쿼리 실행 )
  public function updateMember($id,$pw,$name, $mobile, $grade){
    try {
      $query=$this->db->prepare("update jfmember set pw= :pw, name=:name, mobile=:mobile, grade=:grade where id=:id");

      $query->bindValue(":pw",$pw,PDO::PARAM_STR);
      $query->bindValue(":name",$name,PDO::PARAM_STR);
      $query->bindValue(":mobile",$mobile,PDO::PARAM_STR);
      $query->bindValue(":grade",$grade,PDO::PARAM_STR);
      $query->bindValue(":id",$id,PDO::PARAM_STR);
      $query->execute();

    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }
}
 ?>
