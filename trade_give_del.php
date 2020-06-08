<?php
session_start();
include("PDOInc.php");

if(isset($_GET['id'])){
    $sth = $dbh->prepare('DELETE FROM board_trade_give WHERE id = ?');
    $sth->execute(array((int)$_GET['id']));

    $sth = $dbh->prepare('DELETE FROM board_trade_give_res WHERE root_id = ?');
    $sth->execute(array((int)$_GET['id']));

    echo '<meta http-equiv=REFRESH CONTENT=0;url=trade_give.php>';
}