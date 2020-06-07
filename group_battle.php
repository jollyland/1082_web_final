﻿<?php
session_start();
include("PDOInc.php");

if(isset($_POST['title']) && isset($_POST['rarity']) && isset($_POST['time']) && isset($_POST['password'])){
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
 
<html><head></head>
<body bgcolor="#ccccff">

<?php
    if(isset($_SESSION['id'])){
        echo '歡迎來到團體戰板，<a class="board" href="profile.php?id='.$_SESSION['id'].'">'.$_SESSION['id'].'('.$_SESSION['nickname'].')</a></p>';
        echo '<form action="group_battle.php" method="post">';
        echo '-發文-<br>';
        echo '標題：<input name="title"><br>';
        echo '稀有度：<input name="rarity" placeholder="請輸入1~5"><br>';
        echo '時間：<input type="datetime-local" name="time"><br>';
        echo '密碼：<input name="password"><br>';
        echo '<input type="submit"><br>';
        echo '</form><hr>';
    }
?>
 

<font size="4">文章列表</font><br><br><br>
 
<table border>
    <tr>
        <th>標    題</th>
        <th>發 文 者</th>
        <th>稀 有 度</th>
        <th>時    間</th>
        <th>密    碼</th>
    </tr>
    <?php
        $sql = "SELECT * from board_group_battle ORDER BY time DESC";
        $sth = $dbh->query($sql);
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>".$row['title']."</td>";
            echo "<td>".$row['poster_id']."(".$row['nickname'].")</td>";
            echo "<td>".$row['rarity']."</td>";
            echo "<td>".$row['time']."</td>";
            echo "<td>".$row['password']."</td><tr>";
        }
    ?>
</table>
 
</body></html>