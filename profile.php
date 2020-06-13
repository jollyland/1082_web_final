<?php
session_start();
include("PDOInc.php")
?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>個人頁面</title>
</head>
<body>

<div class="header">        
<?php
    echo '<a class="header_button" href="index.php">回到首頁</a>';
    if(isset($_SESSION['id'])){
    echo '<a class="header_button" href="update_profile.php?id='.$_SESSION['id'].'">編輯資料</a>';

    }
?>
</div>
<div class="profile_body">
<div class="carte">
<table>
        <tr>
            <th>遊戲內ID</th>
            <th>Friend Code</th>
        </tr>
   
        <tr>
    <?php

    $id = $_GET['id'];
    $sth = $dbh->prepare("SELECT * FROM user_data WHERE id = ?");
    $sth->execute(array($id));
    if ($row = $sth->fetch(PDO::FETCH_ASSOC)){  
        echo "<td>".$row['nickname']."</td>";
        if($row['fc_show'] == 1){
          echo "<td>".$row['fc']."</td>";
        }
        else
            echo "<td>未公開</td>";
    }
    

    ?>
        </tr>
</table>
</div>

<div class="profile_pic">
    <div class="profile_card">
    <h3>公開的聯盟卡</h3>
    <?php
    $id = $_GET['id'];
    $sth = $dbh->prepare("SELECT * FROM pic_index WHERE owner = ? AND type = 0 ");
    $sth->execute(array($id));
    if ($row = $sth->fetch(PDO::FETCH_ASSOC)){
        echo "<img class=\"league_card\" src='./uploadFile/".$row['server_path']."'>" ;
        echo "<table><tr><th>聯盟卡密碼</th></tr>";
        echo "<tr><td>".$row['code']."</td></tr></table>";
    }
    ?>    
    </div>
    <div class="profile_team">
    <h3>公開的租用隊伍</h3>
    <table>
        <tr>
            <th>隊伍</th>
            <th>租用密碼</th>
        </tr>
   
        
    <?php
    $id = $_GET['id'];
    $sth = $dbh->prepare("SELECT * FROM pic_index WHERE owner = ? AND type = 1 ");
    $sth->execute(array($id));
    while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td><img class=\"team_pic\" src='./uploadFile/".$row['server_path']."'></td>" ;
        echo "<td>".$row['code']."</td>" ;
        echo "</tr>";
    }
    ?>  
        </tr>
    </table>  
    </div>
</div>

<div class="profile_list">
    <div class="battle_list">
        <h3>發表過的團體戰</h3>
    <table>
    <tr>
        <th>標    題</th>
        <th>稀 有 度</th>
        <th>時    間</th>
        <th>密    碼</th>
        <th>已結束</th>
    </tr>
<?php

    $id = $_GET['id'];
    $sth = $dbh->prepare("SELECT * FROM board_group_battle WHERE poster_id = ? ORDER BY time DESC");
    $sth->execute(array($id));
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
        <table>
            <tr>
                <th>標    題</th>
                <th>寶 可 夢</th>
                <th>時    間</th>
            </tr>

    <?php

    $id = $_GET['id'];
    $sth = $dbh->prepare("SELECT * FROM board_trade_give WHERE poster_id = ? ORDER BY time DESC");
    $sth->execute(array($id));
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){           
            echo '<td><a href="trade_give_res.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></td>';
            echo "<td>".$row['pokemon']."</td>";
            echo "<td>".$row['time']."</td><tr>";
    }

    ?>
        </table>
    </div>

    <div class="seek_list">
        <h3>發表過的徵求</h3>
                <table>
                  <tr>
                       <th>標題</th>
                       <th>寶可夢</th>
                       <th>可以提供</th>
                  </tr>
    <?php

    $id = $_GET['id'];
    $sth = $dbh->prepare("SELECT * FROM board_trade_seek WHERE poster_id = ? ORDER BY id DESC");
    $sth->execute(array($id));

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
</div>
</body>
</html>

	