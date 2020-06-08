<?php
session_start();
include("PDOInc.php")
?>

<?php

$whitelist = array('jpg','png');
$filePath = "./uploadFile/";
$resultStr = '';
$id = $_SESSION['id'];

if( isset($_FILES["pic"]["name"]) && isset($_POST['pic_type'])){
	//寫一些sql到table

    $tmp = explode(".", $_FILES["pic"]["name"]);
    $extension = strtolower(end($tmp));
    $filename = time()."_".$_SESSION['id'];
    $f = md5($filename).".".$extension;

	switch($_POST['pic_type']){
		case 0:
    	$sql = "SELECT * FROM pic_index WHERE owner = '$id' and type = 0 ";
		$sth = $dbh->query($sql);

    	if($row = $sth->fetch(PDO::FETCH_ASSOC)){
    		if(file_exists( $filePath.$row['server_path'] )){
        		unlink($filePath.$row['server_path']);//將檔案刪除
        	}
    		$ds = " DELETE FROM pic_index WHERE owner ='$id' AND type = 0 ";
    		$delete = $dbh->query($ds);
			$ins = 'INSERT INTO pic_index (origin_name, server_path, owner, type, code) VALUES (:name, :filepath, :id, :pictype, :ccode) '; 
    		$insert = $dbh->prepare($ins);
			$insert->bindParam(':name',$filename, PDO::PARAM_STR);
			$insert->bindParam(':filepath',$f, PDO::PARAM_STR);
			$insert->bindParam(':id',$id, PDO::PARAM_STR);
			$insert->bindParam(':pictype',$_POST['pic_type'], PDO::PARAM_STR);
			$insert->bindParam(':ccode',$_POST['card_code'], PDO::PARAM_STR);
			$insert->execute();
    	}
    	
    	else{
    		
    		$ins = 'INSERT INTO pic_index (origin_name, server_path, owner, type, code) VALUES (:name, :filepath, :id, :pictype, :ccode) '; 
    		$insert = $dbh->prepare($ins);
			$insert->bindParam(':name',$filename, PDO::PARAM_STR);
			$insert->bindParam(':filepath',$f, PDO::PARAM_STR);
			$insert->bindParam(':id',$id, PDO::PARAM_STR);
			$insert->bindParam(':pictype',$_POST['pic_type'], PDO::PARAM_STR);
			$insert->bindParam(':ccode',$_POST['card_code'], PDO::PARAM_STR);
			$insert->execute();
    	}

    	if( in_array($extension, $whitelist) && $_FILES["pic"]["size"] <= 1024 * 1024){
       		 move_uploaded_file($_FILES["pic"]["tmp_name"], $filePath.$f);
        		echo "<script>alert(上傳成功！)</script>"; 
        		echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

   		 }
    	else {
		        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    	}
		break;
		
		case 1:
			$sql = "SELECT *  FROM pic_index WHERE owner = '$id' and type = 1 ";
			$sth = $dbh->query($sql);
			$rcount = $sth->rowCount();

			if($rcount < 5){ //沒有超過5對ㄉ時候
	    		$ins = 'INSERT INTO pic_index (origin_name, server_path, owner, type, code) VALUES (:name, :filepath, :id, :pictype, :tcode) '; 
    			$insert = $dbh->prepare($ins);
				$insert->bindParam(':name',$filename, PDO::PARAM_STR);
				$insert->bindParam(':filepath',$f, PDO::PARAM_STR);
				$insert->bindParam(':id',$id, PDO::PARAM_STR);
				$insert->bindParam(':pictype',$_POST['pic_type'], PDO::PARAM_STR);
				$insert->bindParam(':tcode',$_POST['team_code'], PDO::PARAM_STR);
				$insert->execute();
			}
			else{
				$s = 'SELECT server_path, MIN(uptime) FROM pic_index WHERE type =1 ';
				$sth = $dbh->query($s);
    			if($row = $sth->fetch(PDO::FETCH_ASSOC)){
					if(file_exists( $filePath.$row['server_path'] )){
        				unlink($filePath.$row['server_path']);//將檔案刪除
      				}
				}

				$d = 'DELETE FROM pic_index WHERE uptime = (SELECT MIN(uptime) FROM pic_index WHERE type =1) ';
				$delete = $dbh->query($d);
				$ins = 'INSERT INTO pic_index (origin_name, server_path, owner, type, code) VALUES (:name, :filepath, :id, :pictype, :tcode) '; 
    			$insert = $dbh->prepare($ins);
				$insert->bindParam(':name',$filename, PDO::PARAM_STR);
				$insert->bindParam(':filepath',$f, PDO::PARAM_STR);
				$insert->bindParam(':id',$id, PDO::PARAM_STR);
				$insert->bindParam(':pictype',$_POST['pic_type'], PDO::PARAM_STR);
				$insert->bindParam(':tcode',$_POST['team_code'], PDO::PARAM_STR);
				$insert->execute();
				//刪檔案
			}
			if( in_array($extension, $whitelist) && $_FILES["pic"]["size"] <= 1024 * 1024){
       		 move_uploaded_file($_FILES["pic"]["tmp_name"], $filePath.$f);
        		echo "<script>alert(上傳成功！)</script>"; 
        		echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 

   			}
    		else {
		        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    		}
        	 "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
		break;
	}
	
    

    
}
 

?>