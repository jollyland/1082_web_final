<?php
session_start();
include("PDOInc.php");

if(isset($_POST['title']) && isset($_POST['pokemon']) && isset($_POST['time'])){
        $sth = $dbh->prepare(
            'INSERT INTO board_trade_give (title, poster_id, nickname, pokemon, time) VALUES (?, ?, ?, ?, ?)'
        );
        $sth->execute(array(
            $_POST['title'],
            $_SESSION['id'],
            $_SESSION['nickname'],
            $_POST['pokemon'],
            $_POST['time'],
        ));
        echo '<meta http-equiv=REFRESH CONTENT=0;url=trade_give.php>';
}

?>
 
<html><head></head>
<body bgcolor="#ccccff">

<?php
    if(isset($_SESSION['id'])){
        echo '歡迎來到寶可夢贈送板，<a class="board" href="profile.php?id='.$_SESSION['id'].'">'.$_SESSION['id'].'('.$_SESSION['nickname'].')</a></p>';
        echo '<form action="trade_give.php" method="post">';
        echo '-發文-<br>';
        echo '標題：<input name="title"><br>';
        echo '寶可夢：<input name="pokemon"><br>';
        echo '時間：<input type="datetime-local" name="time"><br>';
        echo '<input type="submit"><br>';
        echo '</form><hr>';
    }
?>
 

<font size="4">文章列表</font><br><br><br>
 
<table border>
    <tr>
        <th>標    題</th>
        <th>發 文 者</th>
        <th>寶 可 夢</th>
        <th>時    間</th>
    </tr>
    <?php
        $sql = "SELECT * from board_trade_give ORDER BY id";
        $sth = $dbh->query($sql);
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo '<td><a href="trade_give_res.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></td>';
            echo "<td>".$row['poster_id']."(".$row['nickname'].")</td>";
            echo "<td>".$row['pokemon']."</td>";
            echo "<td>".$row['time']."</td><tr>";
        }
    ?>
</table>
 
</body></html>