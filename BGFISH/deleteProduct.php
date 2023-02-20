<?php
	session_start();
	require_once("conn/Conn.php");
	
	if(isset($_SESSION["user"]) && 0 == strcmp($_SESSION["role"], 'admin')){
		$id = $_GET["id"];
		$img = $_GET["img"];
	try{
		$stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		unlink("images/".$img);
		header("Location: adminPanel.php");
		
	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
	}
?>