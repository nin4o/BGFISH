<?php
	session_start();
	require_once("conn/Conn.php");
	
	$searchProduct = $_POST["searchProduct"];
	
	if(0 != strcmp($username, "")){
		try{
			$stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE '%$searchProduct%' ");
			$stmt->execute();
			
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$searchResult = $stmt->fetchAll();
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style1.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<table>
<?php		
	$count = count($searchResult);
	if($count > 0){
		foreach ($searchResult as $result){
			?>
			<div  id="productFrame">
		<form method="post" action="cart.php">
		<div><?php echo $result["name"]?></div>
		
		
		<input type="hidden" name="hidden_name" value="<?php echo $result["name"];?>">
		<input type="hidden" name="hidden_price" value="<?php echo $result["price"];?>">
		<input type="hidden" name="hidden_ID" value="<?php echo $result["id"];?>">
		<a href="productPage.php?product="<?php echo $result["id"];?>"><img src="images/<?php echo $result["image"]?>" id="productPicture" ></a>
		<input style="margin-top:3px;" type="number" name="quantity" min="1" max="10" value="1">
		<div><?php echo $result["price"]?></div>
		<input type="submit" name="add" id="btnAddToCart" value="&#128722;В количката">
		</div>
		</form>
<?php		
		}
	}else{
		echo '<div>Не е намерен продукт!</div>';
		echo '<a href="index.php">Начало</a>';
	}
	}else{
		echo '<div>Не е намерен продукт!</div>';
		echo '<a href="index.php">Начало</a>';
	}
	?>
	</table>
</body>
</html>	
