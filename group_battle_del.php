<?php
session_start();
include("PDOInc.php");

if(isset($_GET['id'])){
    $sth = $dbh->prepare('DELETE FROM board_group_battle WHERE id = ?');
    $sth->execute(array((int)$_GET['id']));

    echo '<meta http-equiv=REFRESH CONTENT=0;url=group_battle.php>';
}