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
    
    $id = $_SESSION['id'];
    $sql = 'SELECT * FROM user_data' ;
    //echo $_SESSION['id'];

?>
<div class="profile_list">
<?php
    $acc = $_SESSION['id']; 
    echo $acc;
    $s_list = "SELECT * FROM board_group_battle WHERE poster_id = '$acc' ORDER BY time DESC";
    $sth = $dbh->query($s_list);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    foreach ($row as $value) {
    	echo $value;
    }
    //while( !$row ){
    		echo "<br>";
            echo $row['title'];
    		echo "<br>";
            echo $row['poster_id'].$row['nickname'];
    		echo "<br>";
            echo $row['rarity'];
    		echo "<br>";
            echo $row['time'];
    		echo "<br>";
            echo $row['password'];
    //}
	
?>
</div>
</body>
</html>

	