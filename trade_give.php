<?php
session_start();
include("PDOInc.php");

if(isset($_POST['title']) && isset($_POST['pokemon']) && isset($_POST['time']) && $_POST['title']!=null && $_POST['pokemon']!=null && $_POST['time']!=null){
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

<div class="tg_body">

<div class="article_form">
<?php
    if(isset($_SESSION['id'])){
        echo '<form action="trade_give.php" method="post">';
        echo '<h4>-發文-</h4>';
        echo '標題：<input type ="text" name="title"><br>';
        echo '寶可夢：<input type ="text" name="pokemon"><br>';
        echo '時間：<input type="datetime-local" name="time"><br>';
        echo '<input type="submit"><br>';
        echo '</form>';
    }
?>
 </div>

<h4>文章列表</h4>
 
<table >
    <tr>
        <th>標題</th>
        <th>發文者</th>
        <th>寶可夢</th>
        <th>時間</th>
    </tr>
    <?php
        $sql = "SELECT * from board_trade_give ORDER BY id";
        $sth = $dbh->query($sql);
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            echo '<td><a href="trade_give_res.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></td>';
            echo '<td><a href="profile.php?id='.$row['id'].'">'.$row['nickname'].'</a></td>';

            echo "<td>".$row['pokemon']."</td>";
            echo "<td>".$row['time']."</td>";
            if(isset($_SESSION['id'])){
            if($row['poster_id']==$_SESSION['id']){
                echo '<td><a href="trade_give_del.php?id='.$row['id'].'">刪除</a></td>';
            }
            }
            echo "<tr>";
        }
    ?>
</table>
</div>
</body></html>