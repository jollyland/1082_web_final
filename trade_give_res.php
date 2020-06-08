<?php
session_start();
include("PDOInc.php");

if(isset($_POST['password']) && ($_POST['password'])!=null){
        $sth = $dbh->prepare(
            'INSERT INTO board_trade_give_res (root_id, poster_id, nickname, password) VALUES (?, ?, ?, ?)'
        );
        $sth->execute(array(
            $_GET['id'],
            $_SESSION['id'],
            $_SESSION['nickname'],
            $_POST['password'],
        ));
        echo '<meta http-equiv=REFRESH CONTENT=0;url=trade_give_res.php?id='.(int)$_GET['id'].'>';
}

?>


<?php
    function showContent($row){
        $name = htmlspecialchars($row['name']);
        $userid = htmlspecialchars($row['r_id']);
        $pwd = $row['password'];

        echo "回應者：".$name."(".$userid.")<br>";

        if($row['p_id']==$_SESSION['id']){
            echo "密碼：".$pwd."<br>";
        }

    } 
?>

<html><head></head>

<div class="header">

    <?php
    if(isset($_SESSION['id'])){
        echo "<br>";
        echo "<a href=\"logout.php\" class=\"button\">登出</a>";
        echo "<p class=\"log\" >登入身分: ";
        echo '<a class="board" href="profile.php?id='.$_SESSION['id'].'">'.$_SESSION['id'].'</a></p>';

    }
    else{
        echo "<br>";
        echo "<a href=\"login.php\" class=\"button\">登入</a>";
        echo "<a href=\"signup.php\" class=\"button\">沒有帳號，註冊</a>";
    }
    ?>

<a href="index.php">回首頁</a>
<a href="trade_seek.php">回到贈送板</a>

</div>


<?php
    if(isset($_SESSION['id'])){
        echo '<form action="trade_give_res.php?id='.(int)$_GET['id'].'" method="post">';
        echo '-回應-<br>';
        echo '輸入密碼：<input name="password"><br>';
        echo '<input type="submit"><br>';
        echo '</form><hr>';
    }
?>

回應(由早至晚排列)：<br>

<?php
    if(isset($_GET['id'])){
        $sth = $dbh->prepare('
            SELECT P.poster_id as p_id, R.poster_id as r_id, R.nickname as name, R.password as password
            from board_trade_give_res as R, board_trade_give as P
            WHERE root_id = ? and P.id = root_id
            ');
        $sth->execute(array((int)$_GET['id']));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            showContent($row);
        }
    }
?>

</body></html>