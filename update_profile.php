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
        <label for="no">不公開</label>
        <input type="submit" value="確認修改" name="change_show">
    </form>

    <form name = "change_pwd" method="post" action="update_pwd.php ">
    <p>密碼：<input type="password" name="pw" required >(必填) <br></p>
    <p>變更密碼：<input type="password" name="newpwd" > </p>
    <p>確認變更密碼：<input type="password" name="confirmpwd" ></p>
    <input type="submit" name="button" value="確認修改" class="button">
    </form>
<?php

/*


echo "<form method=\"post\" action=\"update_profile.php \" enctype = \"multipart/form-data \" >";
echo "<p>選擇圖片：<input type=\"file\" name=\"pic\" > <br></p>";
echo "<input type=\"submit\" name=\"submit\" value=\"上傳\">";
echo "</form>";
*/

/*

*/


?>
<br>

<form action="upload_pic.php" method="post" enctype="multipart/form-data">
    <label for="file">選擇檔案：</label>
    <input type="file" name="pic"><br>
    <input type="hidden" name="pic_type" value="0">
    <p>公開聯盟卡密碼：<input type="text" name="card_code" maxlength="14"></p>
    <input type="submit" name="submit" value="上傳聯盟卡檔案">
</form>

<br>


<form action="upload_pic.php" method="post" enctype="multipart/form-data">
    <label for="file">選擇檔案：</label>
    <input type="file" name="pic"><br>
    <input type="hidden" name="pic_type" value="1">
    <p>公開隊伍密碼：<input type="text" name="team_code" maxlength="14"></p>
    <input type="submit" name="submit" value="上傳隊伍圖片">
</form>

</body>
</html>

	