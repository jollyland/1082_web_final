<?php
session_start();
include("PDOInc.php");
?>


<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<div class="article_form">
<form action="login.php" method="post" name="form">
    帳號：<input type="text" name="id"><br>
    密碼：<input type="password" name="pwd"><br>
    <input type="submit" name="logbutton" class="button" value="登入" >
</form>
<input type="submit" value="沒有帳號，註冊" onclick="javascript:location.href='signup.php' ">

</div>

<?php
	if( isset($_POST['id']) && isset($_POST['pwd']) ){
		$id = $_POST['id'];
		$pwd = $_POST['pwd'];
		if( $id!=null && $pwd!=null ){
			 $st = $dbh->prepare('SELECT id, password, nickname FROM user_data WHERE id = ?');
			 $st->execute(array($id));
			 $row = $st->fetch(PDO::FETCH_ASSOC);
			if($row != null && $row['password'] == md5($pwd)){
			 	$_SESSION['id'] = $row['id'];
			 	$_SESSION['nickname'] = $row['nickname'];
			 	echo "登入成功";
		 	echo "
			<script>
			setTimeout(function(){window.location.href='index.php';},2000);		
			</script>";
		
		 	}
		else{
			echo "登入失敗！請再次檢查帳號密碼！";
		}		
	}
	else{
		echo "error: wrong user id or pwd";
	}
	}

?>

</body></html>


