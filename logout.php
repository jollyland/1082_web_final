<?php
session_start();
include("PDOInc.php")
?>
<?php
//echo ($_SESSION['id']);
if(!isset($_SESSION['id'])){
    echo '<p style="font-size:25px">操作錯誤！</p>';
    //return;
}else{
    echo '<p style="font-size:25px">登出中</p>';
    session_destroy();
}
echo "跳轉回首頁";
echo "<script>
	  setTimeout(function(){window.location.href='index.php';},2000);
  	  </script>";

?>