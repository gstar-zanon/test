<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
  <title>ユーザー登録</title>
  <meta http-equiv="Content-type" content="text/html; charaset=UTF-8">
  <link rel="stylesheet" type="text/css" href="../CSS/main.css">
<?php
require_once __DIR__.'/ClassList/Common.php';

# ログイン判定
$dbcon = new dbcon();
if(!$dbcon->session()){
  header('Location:index');
  exit();
}

# リクエスト取得
$uname = isset($_POST['uname']) ? $_POST['uname'] : "";
$pass1 = isset($_POST['pass1']) ? $_POST['pass1'] : "";
$pass2 = isset($_POST['pass2']) ? $_POST['pass2'] : "";
$check = isset($_POST['check']) ? 1 : 0;

# HTMLエンティティ
$uname = htmlspecialchars($uname);
$pass1 = htmlspecialchars($pass1);
$pass2 = htmlspecialchars($pass2);
?>
</head>
<body>
<h2>ユーザー登録</h2>
<p>
<form method="post" style="display:inline;">
  ユーザーIDを入力してください(半角英数字6～20文字)<br/>
  <input name="uname" class="text1" type="text" pattern="^([a-zA-Z0-9]{6,20})$" value="<?php echo $uname; ?>"><br/>
  パスワードを入力してください(半角英数字8～25文字以上)<br/>
  <input name="pass1" class="text1" type="password" pattern="^([a-zA-Z0-9]{8,25})$"><br/>
  もう一度入力してください。<br/>
  <input name="pass2" class="text1" type="password" pattern="^([a-zA-Z0-9]{8,25})$"><br/>
  <br/>
  <button class="button1" name="check" type="submit">登録</button>
</form>
<button class="button1" onClick="location.href='index'">キャンセル</button>
</p>
<?php
# 入力チェック
if($check ){
  
  # DB操作クラス
  $dbcon = new dbcon();
  
  # ユーザー作成判定
  $error = 0;
  
  if(!preg_match("/^([a-zA-Z0-9]{6,20})$/", $uname)){
    echo "ユーザーIDは半角英数字6～20文字です。<br/>";
    $error = 1;
  }
  if(!preg_match("/^([a-zA-Z0-9]{8,25})$/", $pass1)){
    echo "パスワードは半角英数字8～25文字です。<br/>";
    $error = 1;
  }
  if($pass1 != $pass2){
    echo "パスワードが一致していません。<br/>";
    $error = 1;
  }
  
  # ユーザーの存在チェック
  if($dbcon->checkuid($uname)){
    echo "そのユーザーIDは使用されています。<br/>";
    $error = 1;
  }
  
  # 作成成功
  if(!$error){
    $dbcon->createuser($uname,$pass1);
    header('Location:CreateSuccess');
    exit();
  }
}
?>
</body>
</html>