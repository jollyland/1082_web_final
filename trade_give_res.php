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

        echo "<tr>";
        echo '<td><a href="profile.php?id='.$userid.'">'.$name.'</a></td>';
        
        if(isset($_SESSION['id'])){
            if($row['p_id']==$_SESSION['id']){
                echo "<td>".$pwd."</td>";
            }
            else{
            echo "<td>僅樓主可見</td>";            
            }
        }
        echo "</tr>";
    } 
?>

<html>
<head>
     <link rel="stylesheet" type="text/css" href="style.css">
     <title>回應</title>
</head>

<div class="header">
    <?php
    echo '<a class="header_button" href="index.php">回到首頁</a>';

    if(isset($_SESSION['id'])){
        echo "<a href=\"logout.php\" class=\"header_button\">登出</a>";
        echo '<a class="header_button" href="profile.php?id='.$_SESSION['id'].'">'.$_SESSION['id'].'</a></p>';

    }
    else{
        echo "<a href=\"login.php\" class=\"header_button\">登入</a>";
        echo "<a href=\"signup.php\" class=\"header_button\">沒有帳號，註冊</a>";
    }

    ?>
</div>
<div class="rs_body">
    <div class="article_form">
<?php
    if(isset($_SESSION['id'])){
        echo '<form action="trade_give_res.php?id='.(int)$_GET['id'].'" method="post">';
        echo '<h4>-回應-</h4>';
        echo '輸入密碼：<input type="text" name="password"><br>';
        echo '<input type="submit"><br>';
        echo '</form>';
    }
?>
</div>

<h4>回應列表</h4>
<table>
    <tr>
        <th>回應者</th>
        <th>密碼</th>
    </tr>

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
</div>
</body></html>