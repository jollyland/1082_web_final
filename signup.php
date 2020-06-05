<?php
session_start();
include("PDOInc.php");
?>


<html>

<head>

<title>註冊頁面</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body>
<div class="signup">

<form action="signup.php" method="post" name="form">
    帳號：<input type="text" name="id" maxlength="20" pattern=".{6,20}" required><br>
    密碼：<input type="password" name="pwd" maxlength="20" pattern=".{6,20}" required><br>
    遊戲ID：<input type="text" name="nickname"  required><br>
    朋友編號：<input type="text" name="fcode" placeholder="請輸入SW後12位數字" maxlength="12" pattern="[0-9]{12}"  required><br>
    是否公開朋友編號：
    <input type="radio" name="public_code" value="yes">
    <label for="yes">公開</label>
    <input type="radio" name="public_code" value="no">
    <label for="no">不公開</label><br>

    <input type="submit" class="button" value="註冊">
</form>
<input type="button" class="button" value = "已經有帳號，登入" onclick="javascript:location.href='login.php' ">
</div>

<?php
if(isset($_SESSSION['id']) && $_SESSSION['id']) {
	echo "已登入";
	echo "
		<script>
		setTimeout(function(){window.location.href='index.php';},2000);
		</script>";
}

if( isset($_POST['id']) && isset($_POST['pwd']) && isset($_POST['nickname']) && isset($_POST['fcode']) && isset($_POST['public_code']) ){ 

	$id = $_POST['id']; //post獲取表單裡的name
	$password = $_POST['pwd']; //post獲取表單裡的password
	$nn = $_POST['nickname'];
	$code = $_POST['fcode'];
	if( $_POST['public_code'] == 'yes') $public = 1;
	else $public = 0;

	
	$sql = "SELECT id FROM user_data WHERE id = '$id' "; 
	$check = $dbh->query($sql);
	$row = $check->fetch(PDO::FETCH_ASSOC);
	if (!$row){
		
		$q="INSERT INTO user_data (id,password,nickname,fc,fc_show) VALUES (:name,:pwd,:nn,:fc,:show)";//向資料庫插入表單傳來的值的sql
		$insert = $dbh->prepare($q);
		$insert->bindParam(':name',$id, PDO::PARAM_STR);
		$p = md5($password);
		$insert->bindParam(':pwd',$p, PDO::PARAM_STR);
		
		$insert->bindParam(':nn',$nn, PDO::PARAM_STR);
		$insert->bindParam(':fc',$code, PDO::PARAM_STR);
		$insert->bindParam(':show',$public, PDO::PARAM_STR);

		$insert->execute();//執行sql
	
		if (!$insert){
			echo "error，請重新註冊";
			echo "
			<script>
			setTimeout(function(){window.location.href='signup.php';},2000);
			</script>";
		}
		else{
			echo "註冊成功，請再次登入！";//成功輸出註冊成功
			
			echo "
			<script>
			setTimeout(function(){window.location.href='signup.php';},2000);		
			</script>";
			
		}
	}
	else{
		echo "此帳號已被註冊，請重新註冊";
		echo "
		<script>
		setTimeout(function(){window.location.href='signup.php';},2000);
		</script>";
	}
	
}

?>
</body>
</html>