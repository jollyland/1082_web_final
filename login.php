<?php
session_start();
include("PDOInc.php");
?>


<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body>
<div class="login_form">
<form action="login.php" method="post" name="form">
    帳號：<input type="text" name="id"><br>
    密碼：<input type="password" name="pwd"><br>
    <input type="submit" name="logbutton" class="button" value="登入" >
</form>

<input class="button" type="button" value="沒有帳號，註冊" onclick="javascript:location.href='signup.php' ">
<br>
</div>

<?php
	if( isset($_POST['id']) && isset($_POST['pwd']) ){
		$id = $_POST['id'];
		$pwd = $_POST['pwd'];
		if( $id!=null && $pwd!=null ){
			 $st = $dbh->prepare('SELECT id, password FROM user_data WHERE id = ?');
			 $st->execute(array($id));
			 $row = $st->fetch(PDO::FETCH_ASSOC);
			if($row != null && $row['password'] == md5($pwd)){
			 	$_SESSION['id'] = $row['id'];
			 	echo "登入成功";
		 	}
		/* 
		echo "
			<script>
			setTimeout(function(){window.location.href='.php';},2000);		
			</script>";
		*/		
	}
	else{
		echo "error: wrong user id or pwd";
	}
	}

?>

</body></html>


<!--看ㄉ到留言ㄉ地方>
