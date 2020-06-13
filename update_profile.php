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

<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>修改個人資料</title>
</head>
<body>
<div class="header">
    <a class="header_button" href="index.php" >回首頁</a>
    <?php
        echo '<a class="header_button" href="profile.php?id='.$_SESSION['id'].'">'."回到個人資料".'</a>';
    ?>
</div>
<div class="up_body">

<div class="up_carte">
    <h4>修改公開資料</h4>
    <form name="change_name" method = "post" action ="update_name.php">
        <label for="newname">修改遊戲ID</label>
        <input type="text" name = "newname"  value="<?php echo htmlspecialchars($_SESSION['nickname']); ?>">
        <br>
        <input type="submit" value="確認修改" name="change_nn">
        </p>
    </form>
<br>
    <form name="change_public" method="post" action="update_show.php">
        <label for="newshow">公開Friend Code</label>
        <input type="radio" name="newshow" value="yes">
        <label for="yes">公開</label>
        <input type="radio" name="newshow" value="no">
        <label for="no">不公開</label><br>
        <input type="submit" value="確認修改" name="change_show">
    </form>
</div>
<br>
<div class="up_pwd">
    <h4>修改密碼</h4>
    <form name = "change_pwd" method="post" action="update_pwd.php ">
    <label for="pw">原密碼</label>
    <input type="password" name="pw" required >
    <br> 
    <label for="newpwd">新密碼</label>
    <input type="password" name="newpwd" >
    <br> 
    <label for="confirmpwd">確認新密碼</label>
    <input type="password" name="confirmpwd" >
    <br> 
    <input type="submit" name="button" value="確認修改" class="button">
    </form>

</div>
<br>

<div class="up_card">
    <h4>上傳聯盟卡</h4>
<form action="upload_pic.php" method="post" enctype="multipart/form-data">
    <label for="file">選擇檔案：</label>
    <input type="file" name="pic"><br>
    <input type="hidden" name="pic_type" value="0">
    <p>公開聯盟卡密碼：<input type="text" name="card_code" maxlength="14"></p>
    <input type="submit" name="submit" value="上傳聯盟卡檔案">
</form>
</div>
<br>
<div class="up_team">
    <h4>上傳租用隊伍</h4>

<form action="upload_pic.php" method="post" enctype="multipart/form-data">
    <label for="file">選擇檔案：</label>
    <input type="file" name="pic"><br>
    <input type="hidden" name="pic_type" value="1">
    <p>公開隊伍密碼：<input type="text" name="team_code" maxlength="14"></p>
    <input type="submit" name="submit" value="上傳隊伍圖片">
</form>
</div>


</div>
</body>
</html>

	