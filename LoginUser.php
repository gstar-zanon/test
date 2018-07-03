<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>テストサイト</title>
	<meta http-equiv="Content-type" content="text/html; charaset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../CSS/main.css">
<?php
require_once __DIR__.'/ClassList/Common.php';

# リクエスト取得
$uname = isset($_POST['uname']) ? $_POST['uname'] : "";
$pass  = isset($_POST['pass']) ? $_POST['pass'] : "";
$check = isset($_POST['check']) ? 1 : 0;

# HTMLエンティティ
$uname = htmlspecialchars($uname);
$pass  = htmlspecialchars($pass);
?>
</head>
<body>
<h2>ログイン</h2>
<p>
<form method="post" style="display:inline;">
	ユーザーIDを入力してください<br/>
	<input name="uname" class="text1" type="text" pattern="^([a-zA-Z0-9]{6,20})$" value="<?php echo $uname; ?>"><br/>
	パスワードを入力してください<br/>
	<input name="pass" class="text1" type="password" pattern="^([a-zA-Z0-9]{8,25})$"><br/>
	<br/>
	<button class="button1" name="check" type="submit">ログイン</button>
</form>
<button class="button1" onClick="location.href='index'">戻る</button>
</p>
<?php
# 入力チェック
if($check ){
	
	# ログイン成功判定
	$error = 0;
	
	if(!$uname){
		echo "ユーザーIDを入力してください。<br/>";
		$error = 1;
	}elseif(!preg_match("/^([a-zA-Z0-9]{6,20})$/", $uname)){
		echo "ユーザーIDは半角英数字6～20文字です。<br/>";
		$error = 1;
	}
		
	if(!$pass){
		echo "パスワードを入力してください。<br/>";
		$error = 1;
	}elseif(!preg_match("/^([a-zA-Z0-9]{8,25})$/", $pass)){
		echo "パスワードは半角英数字8～25文字です。<br/>";
		$error = 1;
	}
	
	# 入力成功
	if(!$error){
		$dbcon = new dbcon();
		if($dbcon->login($uname,$pass)){
			
			# ログイン成功
			//header('Location:index');
			//exit();
		}
		echo "ログインに失敗しました";
	}
}
?>
</body>
</html>