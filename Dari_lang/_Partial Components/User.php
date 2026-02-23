<?php
class User{
	public $host = "localhost";
	public $username = "root";
	public $pass = "";
	public $db_name = "Quiz";
	public $conn;
	public $data;
	public $subject;
	public $qus;

public function __construct(){
	$this->conn=new mysqli($this->host,$this->username,$this->pass,$this->db_name);
	if($this->conn->connect_errno){
		die("database connection failed".$this->conn->connect_errno);
	}
}
	
		public function Subject_show(){
		$query=$this->conn->query("select * from Subject where Language = 'English'");
		while($row=$query->fetch_array(MYSQLI_ASSOC)){
		
			$this->subject[]=$row;
		}
		
		return $this->subject;
	}

	public function answer(){
		// $ans = implode("", $data);
		$right = 0;
		$wrong = 0;
		$no_answer = 0;
		$query = $this->conn->query("SELECT Question_ID,Right_Answer from Question where Subject_ID ='".$_GET['id']."' and Status='1' limit 12");
		mysqli_set_charset($this->conn, 'UTF8');
		while($qust=$query->fetch_array(MYSQLI_ASSOC)){

			if($qust['Right_Answer'] == $_POST[$qust['Question_ID']]){
				$right++;
				
			}
			else if($_POST[$qust['Question_ID']] =="No_Attempt"){
				$no_answer++;
			}
			else{
				$wrong++;
			}
		}
		$array = array();
		$array['right']=$right;
		$array['wrong']=$wrong;
		$array['no_answer']=$no_answer;
		return $array;		
	}


}
