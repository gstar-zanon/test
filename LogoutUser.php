<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
	<title>ログアウト</title>
	<meta http-equiv="Content-type" content="text/html; charaset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../CSS/main.css">
<?php
require_once __DIR__.'/ClassList/Common.php';

$mysql = new mysqli('localhost', 'root', 'mytyan', 'testdb');
if($sql = $mysql->prepare('UPDATE user SET session_id = NULL WHERE user_id = ?')){
	$sql->bind_param('i',$_SESSION['uid']);
	$sql->execute();
	$sql->close();
}

$_SESSION = array();
setcookie('sid', "", time() - 3600);
setcookie(session_name(), '', time()-3600, '/');
session_destroy();
?>
</head>
<body>
ログアウトしました。
</body>
</html>