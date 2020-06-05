<?php
session_start();
include("PDOInc.php")
?>



<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if(isset($_SESSION['id']) && $_GET['id'] == $_SESSION['id']){
	$id = $_SESSION['id'];

	$sql = "SELECT * FROM user_data WHERE id = '$id'";
	$st = $dbh->query($sql);
	$row = $st->fetch(PDO::FETCH_ASSOC);
	$pwd = $row['password'];

	echo "<form name = \"profile\" method=\"post\" action=\"user_data.php \">";
	echo "<p>密碼：<input type=\"password\" name=\"pw\" value=\"\" required/>(必填) <br></p>";
    echo "<p>變更密碼：<input type=\"password\" name=\"newpwd\" value=\"\" /> </p>";
    echo "<p>確認變更密碼：<input type=\"password\" name=\"confirmpwd\" value=\"\" /></p>";
    echo "<input type=\"submit\" name=\"button\" value=\"確認修改\" class=\"button\">";
    echo "</form>";


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
</body>
</html>

	