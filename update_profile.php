<?php
session_start();
include("PDOInc.php")
?>

<?php

if (!isset($_SESSION['id']) || $_GET['id'] != $_SESSION['id']){
    echo "請先登入";
    echo "
        <script>
        setTimeout(function(){window.location.href='login.php';},1500);     
        </script>";
}

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <a class="board" href="profile.php?id='.$_SESSION['id'].'">回到個人頁面</a></p>
    <form name="change_name" method = "post" action ="update_name.php">
        <p>修改遊戲ID：
        <input type="text" name = "newname"  value="<?php echo htmlspecialchars($_SESSION['nickname']); ?>">
        <input type="submit" value="確認修改" name="change_nn">
        </p>
    </form>

    <form name="change_public" method="post" action="update_show.php">
        <p>公開Nitendo Friend Code：
        <input type="radio" name="newshow" value="yes">
        <label for="yes">公開</label>
        <input type="radio" name="newshow" value="no">
        <label for="no">不公開</label><br>
        <input type="submit" value="確認修改" name="change_show">
    </form>
<?php

/*
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


echo "<form method=\"post\" action=\"update_profile.php \" enctype = \"multipart/form-data \" >";
echo "<p>選擇圖片：<input type=\"file\" name=\"pic\" > <br></p>";
echo "<input type=\"submit\" name=\"submit\" value=\"上傳\">";
echo "</form>";
*/

/*
$whitelist = array('jpg', 'png');
$filePath = "./uploadFile/";
$resultStr = '';


if( isset($_FILES["pic"]["name"]) && $_FILES["pic"]["name"]!=NULL){
    $tmp = explode(".", $_FILES["pic"]["name"]);
    $extension = strtolower(end($tmp));
    if( in_array($extension, $whitelist) && $_FILES["pic"]["size"] <= 1024 * 1024){
        $resultStr = "Submit file OK.";
        move_uploaded_file($_FILES["pic"]["tmp_name"], $filePath.$_FILES["pic"]["name"]);
    }
    else {
        $resultStr = "Submit file GG!!";
    }

}
*/


?>
<form action="update_profile.php" method="post" enctype="multipart/form-data">
    <label for="file">選擇檔案：</label>
    <input type="file" name="pic"><br>
    <input type="submit" name="submit" value="上傳">
    <?php //echo $resultStr;?>
</form>

</body>
</html>

	