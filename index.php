<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>テストサイト</title>
	<meta http-equiv="Content-type" content="text/html; charaset=UTF-8">
	<link rel="stylesheet" type="text/css" href="/CSS/main.css">
	<?php require_once __DIR__.'/ClassList/Common.php' ?>
</head>
<body>
<img src="/img/タマちゃん.png" width="25%" height="25%"/><br/>
やあ僕タマちゃん。これから農業ゲームを始めるよ！<br/>
初めての人はユーザー登録を開始してね。<br/>
<a href="CreateUser" >ユーザー登録</a>
<?php
$mysql = new mysqli('localhost', 'root', 'mytyan', 'testdb');
$mysql->close();
?>
</body>
</html>
