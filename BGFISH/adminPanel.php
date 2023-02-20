<?php
require_once("conn/Conn.php");

if(isset($_POST["enter"])) {
$name=$_POST["name"];
$price=$_POST["price"];
$description=$_POST["description"];
$quantity=$_POST["quantity"];
$category=$_POST["category"];

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if($check !== false) {
     //   echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["img"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


try{
	$stmt = $conn->prepare("INSERT INTO products (name, price, description, image, quantity, category) VALUES (:name, :price, :description, :img, :quantity, :category)");
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':price',$price);
	$stmt->bindParam(':description',$description);
	$stmt->bindParam(':quantity',$quantity);
	$stmt->bindParam(':category',$category);
	$basename =basename($_FILES["img"]["name"]);
	$stmt->bindParam(':img',$basename);
	$stmt->execute();
}catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
  }
  
 } 
    
  
  
  $conn = null;

?>
<!Doctype html>
<html>
<head>
		 <link rel="stylesheet" href="style1.css" type="text/css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
	<body id="body">
	
	<ul>
  <li><a href="index.php">Начало</a></li>
  <li><a href="about.php">За нас</a></li>
  <li><a href="contact.php">Контакти</a></li>
  <form method="post" action="search.php">
  <li><input name="searchProduct" id="search" type="text" placeholder="Търси..."></li>
  <li><button id="searchButton" type="submit"><i class="fa fa-search"></i></button></li>
  </form>
  
	<?php
		session_start();
		if(isset ($_SESSION["user"])){
			
		echo '<li class="dropdown">';
		echo '<a href="editAccount.php"><i class="fa fa-fw fa-user"></i>'.$_SESSION["username"].'</a>';
		echo '<div class="dropdown-content">';
		
		echo	'<a href="editAccount.php">Профил</a>';
		if(!strcmp($_SESSION["role"], "admin")){
				echo '<a href="adminPanel.php">Админски панел</a>';
			}
		
		echo	'<a href="conn/logout.php">Изход</a>';
			
		}else{
			
		echo '<li class="dropdown">';
		echo '<a href="register.php"><i class="fa fa-fw fa-user"></i>Профил</a>';
		echo '<div class="dropdown-content">';
			
		echo '<div><a href="enter.php">Вход</a>
			 <a href="register.php">Регистрация</a>
			 </div>';
		}
      ?>
	</div>
  </li>
  <li id="heart">
  <?php
  if(isset ($_SESSION["user"])){
	echo	'<a href="favorites.php"><i class="fa fa-heart-o"></i></a>';
  }
  else{
	  echo '<a href="enter.php"><i class="fa fa-heart-o"></i></a>';
  }
  ?>
  </li>
  <li id="cart">
  <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
  </li>	
		
		
		

</ul><br><br><br><br>

<div id="mySidenav2" class="sidenav">
  <span id="kategorii">Категории</span>
</div>

<div id="mySidenav" class="sidenav">
  <a href="products.php?category=vudici" id="vudici">Въдици</a>
  <a href="products.php?category=makari" id="makari">Макари</a>
  <a href="products.php?category=pluvki" id="pluvki">Плувки</a>
  <a href="products.php?category=vlakna" id="vlakna">Влакна</a>
  <a href="products.php?category=primamki" id="primamki">Примамки</a>
</div>
	
	
		<form method="post" enctype="multipart/form-data" id="formAdminPanel">
			<label for="name">Име:</label>
			<input name="name" type="text" id="name"><br>
			
			<label for="price">Цена:</label>
			<input name="price" type="text" id="price"><br>
			
			<label for="description">Описание:</label>
			<input name="description" type="text" id="description"><br>
			
			<label for="quantity">Бройка:</label>
			<input name="quantity" type="text" id="quantity"><br>
			
			<label for="img">Снимка:</label>
			<input type="file" name="img" id="img"><br>
			
			<select name="category">
			<option value="vudici">Въдици</option>
			<option value="makari">Макари</option>
			<option value="pluvki">Плувки</option>
			<option value="vlakna">Влакна</option>
			<option value="primamki">Примамки</option>
			</select><br>
			
			<input id="btn" type="submit" name="enter" value="Въведи">
		</form>
	</body>
</html>