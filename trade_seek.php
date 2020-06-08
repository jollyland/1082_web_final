<?php
session_start();
include("PDOInc.php");

if(isset($_POST['title']) && isset($_POST['pokemon']) && isset($_POST['offer']) && $_POST['title']!=null && $_POST['pokemon']!=null && $_POST['offer']!=null){
        $sth = $dbh->prepare(
            'INSERT INTO board_trade_seek (title, poster_id, nickname, pokemon, offer) VALUES (?, ?, ?, ?, ?)'
        );
        $sth->execute(array(
            $_POST['title'],
            $_SESSION['id'],
            $_SESSION['nickname'],
            $_POST['pokemon'],
            $_POST['offer'],
        ));
        echo '<meta http-equiv=REFRESH CONTENT=0;url=trade_seek.php>';
}

?>
 
<html><head></head>
<body bgcolor="#ccccff">

<?php
    if(isset($_SESSION['id'])){
        echo '歡迎來到寶可夢徵求板，<a class="board" href="profile.php?id='.$_SESSION['id'].'">'.$_SESSION['id'].'('.$_SESSION['nickname'].')</a></p>';
        echo '<form action="trade_seek.php" method="post">';
        echo '-發文-<br>';
        echo '標題：<input name="title"><br>';
        echo '寶可夢：<input name="pokemon"><br>';
        echo '可提供：<input name="offer"><br>';
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
        <th>可以提供</th>
    </tr>
    <?php
        $sql = "SELECT * from board_trade_seek ORDER BY id";
        $sth = $dbh->query($sql);
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo '<td><a href="trade_seek_res.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></td>';
            echo "<td>".$row['poster_id']."(".$row['nickname'].")</td>";
            echo "<td>".$row['pokemon']."</td>";
            echo "<td>".$row['offer']."</td><td>";
            if($row['poster_id']==$_SESSION['id']){
                echo '<a href="trade_seek_del.php?id='.$row['id'].'">刪除</a>';
            }
            echo "</td><tr>";
        }
    ?>
</table>

<a href="index.php">回首頁</a>
 
</body></html>