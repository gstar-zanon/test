<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charaset=UTF-8">
<link rel="stylesheet" type="text/css" href="../CSS/main.css">
<title>PHP基礎</title>
</head>
<body>
<?php
$mysql = new mysqli('localhost', 'root', 'mytyan', 'phpkiso');

$code = $_POST['code'];

if($sql = $mysql->prepare('SELECT * FROM anketo WHERE code = ?')){
	$sql->bind_param('i',$code);
	$sql->execute();
	
	if($result = $sql->get_result()){
		while($rows = $result->fetch_row()){
			foreach($rows AS $row) echo $row;
			echo '<br/>';
		}
	}
	$sql->close();
}

$mysql->close();
?>
</body>
</html>