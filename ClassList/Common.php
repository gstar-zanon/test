<?php
class dbcon{
	
	private $mysql;
	
	# DB接続
	public function __construct(){
		$this->mysql = new mysqli('localhost', 'root', 'mytyan', 'testdb');
	}
	
	# ユーザー作成
	public function createuser($uname,$pass){
		
		if($sql = $this->mysql->prepare('INSERT INTO user (user_name,pass) VALUES (?,SHA2(?,256))')){
			$sql->bind_param('ss',$uname,$pass);
			$sql->execute();
			$sql->close();
		}
	}
	
	# ユーザーID存在チェック
	public function checkuid($uname){
		
		if($sql = $this->mysql->prepare('SELECT * FROM user WHERE user_name = ?')){
			$sql->bind_param('s',$uname);
			$sql->execute();
			$sql->store_result();
			$uid = $sql->num_rows() ? 1 : 0;
			$sql->close();
		}
		return $uid;
	}
	
	# ログイン処理
	public function login($uname,$pass){
		
		if($sql = $this->mysql->prepare('SELECT * FROM user WHERE user_name = ? AND pass = SHA2(?,256)')){
			$sql->bind_param('ss',$uname,$pass);
			$sql->execute();
			$sql->store_result();
			
			if($sql->num_rows()){
				
				# ログイン成功
				$success = 1;
			}else{
				
				# ログイン失敗
				$success = 0;
				
			}
			$sql->close();
		}
		return $success;
	}
	
	# DB切断
	public function __destruct(){
		$this->mysql->close();
	}
}
?>