<?php
class dbcon{
	
	# ユーザー作成
	public function createuser($uname,$pass){
		$mysql = new mysqli('localhost', 'root', 'mytyan', 'testdb');
		
		if($sql = $mysql->prepare('INSERT INTO user (user_name,pass) VALUES (?,?);')){
			$sql->bind_param('ss',$uname,$pass);
			$sql->execute();
			$sql->close();
		}
		$mysql->close();
	}
	
	# ユーザーID存在チェック
	public function checkuid($uname){
		$mysql = new mysqli('localhost', 'root', 'mytyan', 'testdb');
		
		if($sql = $mysql->prepare('SELECT * FROM user WHERE user_name = ?')){
			$sql->bind_param('s',$uname);
			$sql->execute();
			$sql->store_result();
			$uid = $sql->num_rows() ? 1 : 0;
			$sql->close();
		}
		$mysql->close();
		return $uid;
	}
}
?>