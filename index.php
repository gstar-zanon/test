<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
  <title>テストサイト</title>
  <meta http-equiv="Content-type" content="text/html; charaset=UTF-8">
  <link rel="stylesheet" type="text/css" href="/CSS/main.css">
<?php
require_once __DIR__.'/ClassList/Common.php';

# ログイン判定
$dbcon = new dbcon();
$logout = $dbcon->session() ? 1 : 0;
?>
</head>
<body>
<img src="/img/タマちゃん.png" width="25%" height="25%"/><br/>
<?php
if($logout){
  echo "やあ僕タマちゃん。<br/>";
  echo "初めての人はユーザー登録を開始してね。<br/>";
  echo '<table width="10%">';
  echo '<td><a href="CreateUser" >ユーザー登録</a></td>';
  echo '<td><a href="LoginUser" >ログイン</a></td>';
  echo "</table>";
}else{
  echo "ようこそ".$_SESSION['uname']."さん<br/>";
  echo '<p><a href="LogoutUser" > ログアウト</a></p>';
}
?>
</body>
</html>
