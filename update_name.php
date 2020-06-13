<?php
session_start();
include("PDOInc.php")
?>

<?php
if( isset($_SESSION['id']) && isset($_POST['newname']) ){
    $id = $_SESSION['id'];

    $st = $dbh->prepare("SELECT * FROM user_data WHERE id = ? ");
    $st->execute(array($id));
    $row = $st->fetch(PDO::FETCH_ASSOC);

    $new = $_POST['newname'];
    $_SESSION['nickname'] = $new; 
    $up = $dbh->prepare("UPDATE user_data SET nickname = ? WHERE id = ? ");
    $up->execute( array($new,$id) );
    echo "
        <script>
        setTimeout(function(){window.location.href='index.php';},1500);     
        </script>";

}
else{
    echo "請先登入";
    echo "
        <script>
        setTimeout(function(){window.location.href='login.php';},1500);     
        </script>";

}
?>