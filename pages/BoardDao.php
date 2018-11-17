<?php
class BoardDAO {
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=php", "root", "1111");

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function insertMsg($board, $title, $writer, $content) {
        // sql문 만들고.. insert문
        // prepare 시키고
        // 넘어온 값 binding 시키고
        // 실행요청하고..
        try {
            $sql = "insert into $board(title, writer, content) values(:title, :writer, :content)";
            $pstmt = $this->db->prepare($sql);
            $pstmt->bindValue(":title", $title, PDO::PARAM_STR);
            $pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);
            $pstmt->bindValue(":content", $content, PDO::PARAM_STR);

            $pstmt->execute();

        }catch(PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getManyMsgs($board,$start,$msg) {
        try {
            /*
                1. sql: select * from board;
                2. prepare
                3. binding X, execute O
            */
            $pstmt = $this->db->prepare("select * from $board  order by num desc limit :start, :msg ");

            $pstmt->bindValue(":start",$start,PDO::PARAM_INT);
            $pstmt->bindValue(":msg",$msg,PDO::PARAM_INT);

            $pstmt->execute();
            $msgs = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e) {
            exit($e->getMessage());
        }

        return $msgs;
    }

    public function getNumMsgs($board){
        try{
            $query = $this->db->prepare("select count(*)from $board");
            $query->execute();

            $numMsgs = $query->fetchColumn();
        }catch(PDOException $e){
            exit($e->getMessage());
        }

        return $numMsgs;
    }

    public function getMsg($board,$num) {
        try {
            $sql = "select * from $board where num=:num";
            $pstmt = $this->db->prepare($sql);
            $pstmt->bindValue(":num", $num, PDO::PARAM_STR);
            $pstmt->execute();

            $msg = $pstmt->fetch(PDO::FETCH_ASSOC);

        }catch(PDOException $e) {
            exit($e->getMessage());
        }
        return $msg;
    }

    public function increaseHits($board,$num) {
        try {
            // update board set hits=hits+1 where num=:num
            $sql = "update $board set hits=hits+1 where num=:num";
            $pstmt = $this->db->prepare($sql);
            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->execute();
        }catch(PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function deleteMsg($board,$num) {
        try {
            // update board set hits=hits+1 where num=:num
            $sql = "delete from $board where num=:num";
            $pstmt = $this->db->prepare($sql);
            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->execute();
        }catch(PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function updateMsg($board,$num,$title,$writer,$content){
        try {
            $query=$this->db->prepare("update $board set title=:title, writer=:writer,content=:content where num=:num");

            $query->bindValue(":title",$title,PDO::PARAM_STR);
            $query->bindValue(":writer",$writer,PDO::PARAM_STR);
            $query->bindValue(":content",$content,PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);

            $query->execute();
            $query->execute();

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insertCmt( $boardid,$cwriter, $ctext) {

        try {
            $sql = "insert into jfcomment(boardid, cwriter, ctext) values(:boardid, :cwriter, :ctext)";
            $pstmt = $this->db->prepare($sql);
            $pstmt->bindValue(":boardid", $boardid, PDO::PARAM_STR);
            $pstmt->bindValue(":cwriter", $cwriter, PDO::PARAM_STR);
            $pstmt->bindValue(":ctext", $ctext, PDO::PARAM_STR);

            $pstmt->execute();

        }catch(PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getCmt($boardid) {
        try {
            $sql = "select * from jfcomment where boardid=:boardid";
            $pstmt = $this->db->prepare($sql);
            $pstmt->bindValue(":boardid", $boardid, PDO::PARAM_STR);
            $pstmt->execute();

            $txt = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e) {
            exit($e->getMessage());
        }
        return $txt;
    }

    //게시판 제목으로 검색
    public function searchTitleMsg($search,$start,$rows){
        try{
            $sql ="select * from jfboard where title LIKE '%$search%' order by num desc limit :start, :rows;";
            $pstmt = $this->db->prepare($sql);

            $pstmt->bindValue(":start",$start,PDO::PARAM_INT);
            $pstmt->bindValue(":rows",$rows,PDO::PARAM_INT);
            $pstmt->execute();

            $msg = $pstmt->fetchAll(PDO::FETCH_ASSOC); //레코드를 연관배열로 담아 반환한다.

        }catch(PDOException $e){
            exit($e->getMessage());
        }
        return $msg;
    }

    //게시판 제목으로 검색 수 반환
    public function getSearchTitleMsgs($search){
        try{
            $sql = "select count(*) from  jfboard where title LIKE '%$search%';";
            $pstmt = $this->db->prepare($sql);
            $pstmt->execute();

            $numMsgs = $pstmt->fetchColumn();   // 결과 세트의 다음 행에 있는 단일 컬럼을 리턴합니다.
        }catch(PDOException $e){
            exit($e->getMessage());
        }
        return $numMsgs;
    }







}

?>