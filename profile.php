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
    echo '<a href="index.php">回到首頁</a></p>';
    echo '<a class="board" href="update_profile.php?id='.$_SESSION['id'].'">修改資料</a></p>';
    
    $id = $_SESSION['id'];
    $sql = 'SELECT * FROM user_data' ;
    //echo $_SESSION['id'];

?>
<div class="profile_list">
    <div class="battle_list">
        <h3>發表過的團體戰</h3>
    <table border>
    <tr>
        <th>標    題</th>
        <th>稀 有 度</th>
        <th>時    間</th>
        <th>密    碼</th>
        <th>已結束</th>
    </tr>
<?php

    $id = $_SESSION['id'];
    $s_list = "SELECT * FROM board_group_battle WHERE poster_id = '$id' ORDER BY time DESC";
    $sth = $dbh->query($s_list);
    $row = $sth->fetch(PDO::FETCH_ASSOC);

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){      
            echo "<tr><td>".$row['title']."</td>";
            echo "<td>".$row['rarity']."</td>";
            echo "<td>".$row['time']."</td>";
            echo "<td>".$row['password']."</td>";
            if ($row['end'] == 0){ 
                echo "<td>否</td><tr>";
            }
            else{
                echo "<td>是</td><tr>";
            }


    }
?>
</table>
    </div>
    <div class="give_list">
        <h3>發表過的贈送</h3>
        <table border>
            <tr>
                <th>標    題</th>
                <th>寶 可 夢</th>
                <th>時    間</th>
            </tr>

    <?php

    $id = $_SESSION['id'];
    $s_list = "SELECT * FROM board_trade_give WHERE poster_id = '$id' ORDER BY time DESC";
    $sth = $dbh->query($s_list);

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            
            echo '<td><a href="trade_give_res.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></td>';
            echo "<td>".$row['pokemon']."</td>";
            echo "<td>".$row['time']."</td><tr>";
        
            //好像也是要有沒有結束&貼文連結
    }

    ?>
        </table>
    </div>

    <div class="seek_list">
        <h3>發表過的徵求</h3>
                <table border>
                  <tr>
                       <th>標    題</th>
                       <th>寶 可 夢</th>
                       <th>可以提供</th>
                  </tr>
    <?php

    $id = $_SESSION['id'];
    $s_list = "SELECT * FROM board_trade_seek WHERE poster_id = '$id' ORDER BY id DESC";
    $sth = $dbh->query($s_list);

    while( $row = $sth->fetch(PDO::FETCH_ASSOC) ){
            echo '<td><a href="trade_seek_res.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></td>';
            echo "<td>".$row['pokemon']."</td>";
            echo "<td>".$row['offer']."</td><tr>";
            //好像也是要有沒有結束&貼文連結
    }
    ?>
        </table>
    </div>

</div>
</body>
</html>

	