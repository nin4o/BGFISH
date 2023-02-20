<?php 
	session_start();
	require_once("conn/Conn.php");
	$array = $_POST["jsonData"];
	$normalArr = json_decode($array, true);
	
	try {
			$stmt = $conn ->prepare("SELECT * from favorites WHERE fk_product_id = :productID AND fk_accounts_id = :accountID");
			$stmt->bindParam(":productID", $normalArr[2]);
			$stmt->bindParam(":accountID", $normalArr[1]);
			$stmt->execute();
				
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$q = $stmt->fetchAll();
			
			$fav = count($q);
			
			
			if($fav >0){
				$fav = 1;
			}else{
				$fav = 0;
			}
			
			if(1 == $normalArr[0] && 0 == $fav){
				$stmt = $conn->prepare("INSERT INTO favorites VALUES(:fk_product_id, :fk_accounts_id)");
				$stmt->bindParam(":fk_product_id", $normalArr[2]);
				$stmt->bindParam(":fk_accounts_id", $normalArr[1]);
				$stmt->execute();
			} elseif(0 == $normalArr[0] && 1 == $fav){
				$stmt = $conn->prepare("DELETE FROM favorites WHERE fk_product_id = :fk_product_id AND fk_accounts_id = :fk_accounts_id");
				$stmt->bindParam(":fk_product_id", $normalArr[2]);
				$stmt->bindParam(":fk_accounts_id", $normalArr[1]);
				$stmt->execute();
			}
			
	}catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
	
	$conn = NULL;
?>