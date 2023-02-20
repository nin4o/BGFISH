<?php
	session_start();
	//$user =$_SESSION["user"];
	require_once("conn/Conn.php");
?>
<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Любими продукти | BG FISH</title>
		
		 <link rel="stylesheet" href="style1.css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body id="body" >
	
	
		<ul>
  <li><a href="index.php">Начало</a></li>
  <li><a href="about.php">За нас</a></li>
  <li><a href="contact.php">Контакти</a></li>
  <form method="post" action="search.php">
  <li><input name="searchProduct" id="search" type="text" placeholder="Търси..."></li>
  <li><button id="searchButton" type="submit"><i class="fa fa-search"></i></button></li>
  </form>
  
	<?php
		
		
		
		
		
		if(isset ($_SESSION["user"])){
			
		echo '<li class="dropdown">';
		echo '<a href="editAccount.php"><i class="fa fa-fw fa-user"></i>'.$_SESSION["username"].'</a>';
		echo '<div class="dropdown-content">';
		
		echo	'<a href="editAccount.php">Профил</a>';
		if(!strcmp($_SESSION["role"], "admin")){
				echo '<a href="adminPanel.php">Админски панел</a>';
			}
		echo	'<a href="conn/logout.php">Изход</a>';
		}
		else{
			
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
  <a href="favorites.php"><i class="fa fa-heart-o"></i></a>
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
	
<?php 
	try {
			$stmt = $conn ->prepare("SELECT products.name, products.image, products.price, products.id
			FROM products 
			INNER JOIN favorites ON products.id = favorites.fk_product_id 
			WHERE favorites.fk_accounts_id = :id");
			$stmt->bindParam(":id", $_SESSION["user"]);
			$stmt->execute();
				
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$q = $stmt->fetchAll();
			//var_dump($q);
	}catch(PDOException $e){
				echo "Connection failed: " . $e->getMessage();
			}
			foreach($q as $product){
		echo '<div id="favProductID">',
		'<div>'.$product["name"].'</div>',
		'<a href="productPage.php?product='.$product["id"].'"><img src="images/'.$product["image"].'" id="favProductPictureID"></a>',
		'<div>'.$product["price"].'лв.</div></div>';
			}
?>	

<!-- Footer -->

	</body>
	</html>
