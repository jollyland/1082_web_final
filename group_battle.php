﻿<?php
session_start();
include("PDOInc.php");

if(isset($_POST['title']) && isset($_POST['rarity']) && isset($_POST['time']) && isset($_POST['password']) && $_POST['title']!=null && $_POST['rarity']!=null && $_POST['time']!=null && $_POST['password']!=null){
        $sth = $dbh->prepare(
            'INSERT INTO board_group_battle (title, poster_id, nickname, rarity, time, password) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $sth->execute(array(
            $_POST['title'],
            $_SESSION['id'],
            $_SESSION['nickname'],
            $_POST['rarity'],
            $_POST['time'],
            $_POST['password']
        ));
        echo '<meta http-equiv=REFRESH CONTENT=0;url=group_battle.php>';
}

?>
 
<html>
<head>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <?php
    echo '<a class="header_button" href="index.php">回到首頁</a>';

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

<div class="gp_body">
<div class="article_form">
<?php
    if(isset($_SESSION['id'])){
        echo '<form action="group_battle.php" method="post">';
        echo '<h4>-發文-</h4>';
        echo '標題：<input type="text" name="title"><br>';
        echo '稀有度：<input type="text" name="rarity" placeholder="請輸入1~5"><br>';
        echo '時間：<input type="datetime-local" name="time"><br>';
        echo '密碼：<input type="text" name="password"><br>';
        echo '<input type="submit"><br>';
        echo '</form>';
    }
?>
 </div>
<br>

<h4>文章列表</h4>
 
<table >
    <tr>
        <th>標題</th>
        <th>發文者</th>
        <th>稀有度</th>
        <th>時間</th>
        <th>密碼</th>
    </tr>
    <?php
        $sql = "SELECT * from board_group_battle ORDER BY time DESC";
        $sth = $dbh->query($sql);
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>".$row['title']."</td>";
            echo '<td><a href="profile.php?id='.$row['poster_id'].'">'.$row['nickname'].'</a></td>';
            echo "<td>".$row['rarity']."</td>";
            echo "<td>".$row['time']."</td>";
            echo "<td>".$row['password']."</td><td>";
            if($row['poster_id']==$_SESSION['id']){
                echo '<a href="group_battle_del.php?id='.$row['id'].'">刪除</a>';
            }
            echo "</td><tr>";
        }
    ?>
</table>
</div>
</body></html>