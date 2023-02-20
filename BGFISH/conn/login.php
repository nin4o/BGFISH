<?php
	session_start();
	require_once("Conn.php");
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	try {
	$stmt = $conn->prepare("SELECT id, password, username, role FROM accounts WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count = $stmt->rowCount();
	$result = $stmt ->setFetchMode(PDO::FETCH_ASSOC);
	$user = $stmt->fetchAll();
	
	
	
	if(($count > 0) && password_verify($password, $user[0]["password"])){
	   $_SESSION["user"] = $user[0]["id"];
	   $_SESSION["username"] = $user[0]["username"];
	   $_SESSION["role"] = $user[0]["role"];
	   header("Location: ../index.php");
    }else{
       header("Location: ../register.php");
	   session_destroy();
    }
	}
  catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
  }
  $conn = null;
?>

