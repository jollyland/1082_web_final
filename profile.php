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
    echo '<a class="board" href="update_profile.php?id='.$_SESSION['id'].'">修改資料</a></p>';
?>
</body>
</html>

	