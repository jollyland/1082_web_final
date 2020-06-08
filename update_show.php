<?php
session_start();
include("PDOInc.php")
?>

<?php
if( isset($_SESSION['id']) && isset($_POST['newshow']) ){
    $id = $_SESSION['id'];

    $sql = "SELECT * FROM user_data WHERE id = '$id'";
    $st = $dbh->query($sql);
    $row = $st->fetch(PDO::FETCH_ASSOC);

    if($_POST['newshow'] == 'yes')
    	$new = 1;
    else
    	$new = 0;
    $up = $dbh->prepare("UPDATE user_data SET fc_show = ? WHERE id = '$id' ");
    $up->execute( array($new) );
    echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    

}
else{
    echo "請先登入";
    echo "
        <script>
        setTimeout(function(){window.location.href='login.php';},1500);     
        </script>";

}
?>