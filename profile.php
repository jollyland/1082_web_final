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
    <div class="battle_list">
<?php
    $id = $_SESSION['id'];
    $s_list = "SELECT * FROM board_group_battle WHERE poster_id = '$id' ORDER BY time DESC";
    $sth = $dbh->query($s_list);
    $row = $sth->fetch(PDO::FETCH_ASSOC);

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    		echo "<br>";
            echo $row['title'];
    		echo "<br>";
            echo $row['rarity'];
    		echo "<br>";
            echo $row['time'];
    		echo "<br>";
            echo $row['password'];
            echo "<br>";
            echo $row['end'];
    }
?>
    </div>
    <div class="give_list">
    <?php

    $id = $_SESSION['id'];
    $s_list = "SELECT * FROM board_trade_give WHERE poster_id = '$id' ORDER BY time DESC";
    $sth = $dbh->query($s_list);

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<br>";
            echo $row['title'];
            echo "<br>";
            echo $row['pokemon'];
            echo "<br>";
            echo $row['time'];
            //好像也是要有沒有結束&貼文連結
    }

    ?>
    </div>

    <div class="seek_list">
    <?php

    $id = $_SESSION['id'];
    $s_list = "SELECT * FROM board_trade_seek WHERE poster_id = '$id' ORDER BY id DESC";
    $sth = $dbh->query($s_list);

    while( $row = $sth->fetch(PDO::FETCH_ASSOC) ){
            echo "<br>";
            echo $row['title'];
            echo "<br>";
            echo $row['pokemon'];
            echo "<br>";
            echo $row['offer'];
            //好像也是要有沒有結束&貼文連結
    }
    ?>
    </div>

</div>
</body>
</html>

	