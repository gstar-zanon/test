<?php
class dbcon{
	
	private $mysql;
	
	# DB接続
	public function __construct(){
		$this->mysql = new mysqli('localhost', 'root', 'mytyan', 'testdb');
	}
	
	# ログイン中処理
	public function session(){
		
		if($sql = $this->mysql->prepare('SELECT user_id,user_name FROM user WHERE session_id = ?')){
			
			$sid = session_id();
			$sql->bind_param('s',$sid);
			$sql->execute();
			$sql->store_result();
			
			# セッション保持
			if($sql->num_rows() === 1){
				$sql->bind_result($uid, $uname);
				$sql->fetch();
				session_regenerate_id(true);
				$sid = session_id();
				$_SESSION['uid']   = $uid;
				$_SESSION['uname'] = $uname;
				setcookie('sid',$sid,time() + 259200);
				if($sql = $this->mysql->prepare('UPDATE user SET session_id = ? WHERE user_id = ?')){
					$sql->bind_param('si',$sid,$uid);
					$sql->execute();
				}else return 1;
				
			# セッション無し
			}elseif(isset($_COOKIE['sid'])){
				$sid = $_COOKIE['sid'];
				$sql->bind_param('s',$sid);
				$sql->execute();
				$sql->store_result();
				if($sql->num_rows() === 1){
					$sql->bind_result($uid, $uname);
					$sql->fetch();
					session_regenerate_id(true);
					$sid = session_id();
					$_SESSION['uid']   = $uid;
					$_SESSION['uname'] = $uname;
					setcookie('sid',$sid,time() + 259200);
					if($sql = $this->mysql->prepare('UPDATE user SET session_id = ? WHERE user_id = ?')){
						$sql->bind_param('si',$sid,$uid);
						$sql->execute();
					}else return 1;
				}else return 1;
			}else return 1;
			$sql->close();
		}else return 1;
		return 0;
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
		
		if($sql = $this->mysql->prepare('SELECT user_name FROM user WHERE user_name = ?')){
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
		
		$success = 0;
		
		if($sql = $this->mysql->prepare('SELECT user_name FROM user WHERE user_name = ? AND pass = SHA2(?,256)')){
			$sql->bind_param('ss',$uname,$pass);
			$sql->execute();
			$sql->store_result();
			if($sql->num_rows()){
				
				# ログイン成功
				if($sql = $this->mysql->prepare('UPDATE user SET session_id = ? WHERE user_name = ?')){
					$success = 1;
					$sid = session_id();
					$sql->bind_param('ss',$sid,$uname);
					$sql->execute();
				}
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