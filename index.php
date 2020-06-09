<?php
session_start();
include("PDOInc.php")
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<html>
<head>
	 <link rel="stylesheet" type="text/css" href="style.css">
	 <title>寶可夢遺失物招領處</title>
</head>
<body>

	<div class="header">
	<?php
	if(isset($_SESSION['id'])){
		echo "<a href=\"logout.php\" class=\"header_button\">登出</a>";
        echo '<a class="header_button" href="profile.php?id='.$_SESSION['id'].'">'.$_SESSION['id'].'</a></p>';

	}
	else{
		echo "<br>";
		echo "<a href=\"login.php\" class=\"header_button\">登入</a>";
		echo "<a href=\"signup.php\" class=\"header_button\">沒有帳號，註冊</a>";
	}
	?>

	</div>
	
	<div class="index_banner">
		<image src = "./image/banner.jpg" width = 100%>
	</div>

	<div class ="board_list">
	<table width="3000" height="800">

		<a class="sel_board" href="group_battle.php">團體戰板</a>
		<a class="sel_board" href="trade_give.php">寶可夢贈送板</a>
		<a class="sel_board" href="trade_seek.php">寶可夢徵求板</a>

	</table>
</div>
</body>


</html>
