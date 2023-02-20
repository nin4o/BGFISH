<?php
	session_start();
	require_once("Conn.php");
	$username= $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirmPassword = $_POST["confirmPassword"];
	
	$errors = array(
		"username" => array(),
		"password" => array(),
		"email" => array(),
		"confirmPassword" => array()
	);
	
	if($username == ""){
		$errors["username"][] = "Username should not be empty!";
	}
	
	if(strlen($username) < 3 || strlen($username) > 15){
    $errors["username"][] = "Username should be between 3 and 15 characters!";
    }
	
	if($password == ""){
    $errors["password"][] = "Password should not be empty!";
	}
	
	if(strlen($password) < 6 || strlen($password) > 20){
    $errors["password"][] = "Password should be between 6 and 20 characters!";
	}
	
	if($confirmPassword == ""){
    $errors["confirmPassword"][] = "Password should not be empty!";
	}
	
	if($email == ""){
    $errors["email"][] = "Email should not be empty!";
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors["email"][] = "Invalid email format";
    }
	
	if(strcmp($password, $confirmPassword)!=0){
		$errors["confirmPassword"][] = "Password does not match!";
	}
	
	try {
   		$stmt = $conn->prepare("SELECT username FROM accounts WHERE email = :email");
   		$stmt->bindParam(":email", $email);
   		$stmt->execute();
   		$count = $stmt->rowCount();
   	} catch (PDOException $e) {
   		echo "Error: " . $e->getMessage();
   	}

   	if($count > 0){
   		$errors["email"][] = "This email is already registered!";
   	}
	
	$count = 0;
	
	foreach($errors as $error){
			if(count($error)>0){
				$count++;
			}
	}
	
	
	if($count <= 0){
	try {
	  $hashedPass = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO accounts (username, email, password)
      VALUES (:username, :email, :password)");
	   $stmt->bindParam(":username", $username);
	   $stmt->bindParam(":email", $email);
	   $stmt->bindParam(":password", $hashedPass);
	   $stmt->execute();
       header("Location: ../enter.php");
       }
    catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	   }
		}else{
			header("Location: ../register.php");
			$_SESSION["errors"] = $errors;
		}
  $conn = null;
?>