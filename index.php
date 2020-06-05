<?php
session_start();
include("PDOInc.php")
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<html>
<head>
</head>
<body>

	<div class="header">

	<?php
	if(isset($_SESSION['id'])){
		echo "<br>";
		echo "<a href=\"logout.php\" class=\"button\">登出</a>";
		echo "<a href=\"profile.php\" class=\"button\">修改資料</a>";
		echo "<p class=\"log\" >登入身分: ";
        echo '<a class="board" href="profile.php?id='.$_SESSION['id'].'">'.$_SESSION['id'].'</a></p>';

	}
	else{
		echo "<br>";
		echo "<a href=\"login.php\" class=\"button\">登入</a>";
		echo "<a href=\"signup.php\" class=\"button\">沒有帳號，註冊</a>";
	}
	?>

	</div>
	<div class="board_list">
	</div>
</body>


</html>
