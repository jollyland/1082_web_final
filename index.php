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
	<table width="3000" height="800">
	<font size="6">寶可夢遺失物招領處</font><br>

		<a href="group_battle.php">團體戰板</a>
		<a href="board_trade_give.php">寶可夢贈送板</a>
		<a href="board_trade_seek.php">寶可夢徵求板</a>

	</table>
</body>


</html>
