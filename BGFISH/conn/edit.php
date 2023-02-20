<?php
	session_start();
	require_once("Conn.php");
	$user_id = $_SESSION["user"];	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$confirmNewPassword = $_POST["confirmNewPassword"];
	$email = $_POST["email"];
	$oldPassword = $_POST["oldPassword"];
	
	try{
		$stmt = $conn->prepare("SELECT password FROM accounts WHERE id=:id");
		$stmt->bindParam(":id", $user_id);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$pass_cmp = $stmt->fetchAll();
		
		$errors = array(
			"username" => array(),
			"email" => array(),
			"password" => array(),
			"confirmNewPassword" => array(),
			"oldPassword" => array()
		);
		
		if($username == ""){
		$errors["username"][] = "Username should not be empty!";
		}

		if(strlen($username) < 3 || strlen($username) > 15){
			$errors["username"][] = "Nickname should be between 3 and 15 characters!";
		}

		if($email == ''){
			$errors["email"][] = "Email should not be empty!";
		}

		if(strlen($email) > 30){
			$errors["email"][] = "Email shouldn't be longer than 30 characters!";
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors["email"][] = "Invalid email format!";
		}

		if(!password_verify($oldPassword, $pass_cmp[0]["password"])){
			$errors["oldPassword"] = "Wrong authentication password!";
		}

		$count = 0;
		
		foreach ($errors as $value) {
			if(count($value) > 0){
				$count++;
			}
		}

		if($count <= 0){
			$stmt = $conn->prepare("UPDATE accounts
				SET username = :username, email = :email, password = :password
					WHERE id = :id");
			$stmt->bindParam(":username", $username);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":id", $user_id);

			if(strlen($password) != 0 && strlen($confirmNewPassword) != 0){
				if (strlen($password) < 6 || strlen($password) > 20) {
					$errors["password"][] = "Password should be between 6 and 20 characters!";
					$_SESSION["errors"] = $errors;
					header("Location: ../editAccount.php");
				} else {
					if (strcmp($password, $confirmNewPassword) == 0) {
						$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
						$stmt->bindParam(":password", $hashedPassword);
						$stmt->execute();
						header("Location: ../editAccount.php");
					} else {
						$errors["confirmNewPassword"][] = "Passwords do not match!";
						$_SESSION["errors"] = $errors;
						header("Location: ../editAccount.php");
					}
				}
			} else {
				if ((strlen($password) > 0 && strlen($confirmNewPassword) == 0) || 
					(strlen($password) == 0 && strlen($confirmNewPassword) > 0)) {
					$errors["confirmNewPassword"][] = "Passwords do not match!";
					$_SESSION["errors"] = $errors;
					header("Location: ../editAccount.php");
				} else {
					$stmt->bindParam(":password", $pass_cmp[0]["password"]);
					$stmt->execute();
					header("Location: ../editAccount.php");
				}
			}
		} else{
			$_SESSION["errors"] = $errors;
			header("Location: ../editAccount.php");
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = NULL;
	
?>