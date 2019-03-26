<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
	<title>テストサイト</title>
	<meta http-equiv="Content-type" content="text/html; charaset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../CSS/main.css">
<?php
require_once __DIR__.'/ClassList/Common.php';

# ログイン判定
$dbcon = new dbcon();
if($dbcon->session()){
  header('Location:LoginUser');
  exit();
}
?>
</head>
<body>

</body>
</html>