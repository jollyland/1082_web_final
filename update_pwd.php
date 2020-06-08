<?php
session_start();
include("PDOInc.php")
?>

<?php
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];

	$sql = "SELECT * FROM user_data WHERE id = '$id'";
	$st = $dbh->query($sql);
	$row = $st->fetch(PDO::FETCH_ASSOC);
	$pwd = $row['password'];

    if(isset($_POST['pw'])){
    	if( md5($_POST['pw']) != $pwd ){
    		echo "密碼錯誤!";

    	}
    	else{
    		if( !isset($_POST['newpwd']) && !isset($_POST['confirmpwd'])){
    			echo "請輸入完整資料";
    		}
    		else if ( ($_POST['newpwd'] == null) || ($_POST['confirmpwd'] == null)){
    			echo "請輸入完整資料";
    		}
    		else{
    			if( $_POST['newpwd'] == $_POST['confirmpwd'])
    			{
    				$new = md5($_POST['newpwd']);
    				$up = $dbh->prepare("UPDATE user SET password = ? WHERE id = '$id' ");
    				$up->execute( array($new) );

    				echo "修改成功，請重新登入";
    				echo "
						<script>
						setTimeout(function(){window.location.href='login.php';},2000);		
						</script>";
    			}
    			else{
    				echo "新密碼不相符";
    			}
    		}
    	}

    }
}
else{
	echo "請先登入";
	echo "
		<script>
		setTimeout(function(){window.location.href='login.php';},2000);		
		</script>";
}
?>