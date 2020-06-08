<?php
session_start();
include("PDOInc.php");

if(isset($_POST['password']) && isset($_POST['want']) && isset($_POST['time']) && $_POST['password']!=null && $_POST['time']!=null && $_POST['want']!=null){
        $sth = $dbh->prepare(
            'INSERT INTO board_trade_seek_res (root_id, poster_id, nickname, want, time, password) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $sth->execute(array(
            $_GET['id'],
            $_SESSION['id'],
            $_SESSION['nickname'],
            $_POST['want'],
            $_POST['time'],
            $_POST['password'],
        ));
        echo '<meta http-equiv=REFRESH CONTENT=0;url=trade_seek_res.php?id='.(int)$_GET['id'].'>';
}

?>


<?php
    function showContent($row){
        $name = htmlspecialchars($row['name']);
        $userid = htmlspecialchars($row['r_id']);
        $want = htmlspecialchars($row['want']);
        $time = htmlspecialchars($row['time']);
        $pwd = $row['password'];


        echo "回應者：   ".$name."(".$userid.")<br>";
        echo "想要的寶可夢：   ".$want."<br>";

        if($row['p_id']==$_SESSION['id']){
            echo "可交換時間：".$time."<br>";
            echo "密碼：".$pwd."<br><br>";
        }

    } 
?>

<html><head></head>

<?php
    if(isset($_SESSION['id'])){
        echo '<form action="trade_seek_res.php?id='.(int)$_GET['id'].'" method="post">';
        echo '-回應-<br>';
        echo '想換的寶可夢：<input name="want"><br>';
        echo '時間：<input type="datetime-local" name="time"><br>';
        echo '輸入密碼：<input name="password"><br>';
        echo '<input type="submit"><br>';
        echo '</form><hr>';
    }
?>

回應(由早至晚排列)：<br>

<?php
    if(isset($_GET['id'])){
        $sth = $dbh->prepare('
            SELECT P.poster_id as p_id, R.poster_id as r_id, R.nickname as name, R.password as password, R.time as time, R.want as want
            from board_trade_seek_res as R, board_trade_seek as P
            WHERE root_id = ? and P.id = root_id
            ');
        $sth->execute(array((int)$_GET['id']));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            showContent($row);
        }
    }
?>

</body></html>