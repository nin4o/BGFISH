<?php
	session_start();
	require_once("conn/Conn.php");
	
	$id = $_GET["product"];
	
	try{
		$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$product =$stmt->fetchAll();
		
		
	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
	
	function favoriteButton($productID, $accountID, $conn){
			try {
				$stmt = $conn ->prepare("SELECT * from favorites WHERE fk_product_id = :productID AND fk_accounts_id = :accountID");
				$stmt ->bindParam(":productID", $productID);
				$stmt ->bindParam(":accountID", $accountID);
				$stmt ->execute();
				
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				$q = $stmt->fetchAll();
			}catch(PDOException $e){
				echo "Connection failed: " . $e->getMessage();
			}
			
			$fav = count($q);
			
			if ($fav == 0){
				echo '<button id="favBtn'.$productID.'" onclick="favorite(1, '.$_SESSION["user"].', '.$productID.')"><i class="fa fa-heart-o"></i></button>';
				echo '<button id="notFavBtn'.$productID.'" onclick="favorite(0, '.$_SESSION["user"].', '.$productID.')"><i class="fa fa-heart" aria-hidden="true"></i></button>';
				echo '<style scoped>';
				echo '#notFavBtn'.$productID.'{display:none;}';
				echo '</style>';
			}else{
				echo '<button id="favBtn'.$productID.'" onclick="favorite(1,'.$_SESSION["user"].', '.$productID.')"><i class="fa fa-heart-o"></i></button>';
				echo '<button id="notFavBtn'.$productID.'" onclick="favorite(0, '.$_SESSION["user"].', '.$productID.')"><i class="fa fa-heart" aria-hidden="true"></i></button>';
				echo '<style scoped>';
				echo '#favBtn'.$productID.'{display:none;}';
				echo '</style>';
			}
		}
	

	
	
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style1.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="favorites.js"></script>
<title><?php echo $product[0]["name"];?></title>


</head>
	<body>
	
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
  

</ul><br><br><br><br><br><br>

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
			echo '<div id="productPageID">',
		'<div>'.$product[0]["name"].'</div>',
		'<img src="images/'.$product[0]["image"].'" id="productPictureID">',
		'<input style="margin-top:3px;" type="number" name="quantity" min="1" max="10" value="1">',
		'<div>'.$product[0]["price"].'лв.</div>',
		'<div>'.$product[0]["description"].'</div>',
		'<form method="post" action="cart.php">';
		if(isset($_SESSION["user"])){
		echo '<input type="submit" name="add" id="btnAddToCart" value="&#128722;В количката">';}
		echo '</form>';
		//echo '<div>'.$product[0]["category"].'</div>';
			if(isset($_SESSION["user"])){
			favoriteButton($product[0]["id"], $_SESSION["user"], $conn);}
			if(isset($_SESSION["user"]) && 0 == strcmp($_SESSION["role"], 'admin')){
				echo '<a href="deleteProduct.php?id='.$product[0]["id"].'&img='.$product[0]["image"].'" id="testDelete">Изтриване</a>';
			}
		echo '<input type="hidden" name="hidden_name" value="'.$product[0]["name"].'">',
		'<input type="hidden" name="hidden_price" value="'.$product[0]["price"].'">',
		'<input type="hidden" name="hidden_ID" value="'.$product[0]["id"].'">',
		'</div>';
			$conn = null;
		?>
		
		<br><br>
<footer>
    <div id="footer-holderRelative">
        <span>(C) BG FISH. All rights reserved.</span>
        <p>Developed by Naiden Naidenov</p>
    

      <div>
        <a href ="https://www.facebook.com/profile.php?id=100001291393464" target="_blank">
        <img src="images/Facebook.png" alt="Facebook" style="width:50px">
        </a>
        <a href ="https://github.com/nin4o/REPO2" target="_blank">
          <img src="images/Github.png" alt="Github" style="width:60px">
        </a>
        <a href ="index.php">
            <img src="images/BgFish.png" alt="BgFish" style="width:50px">
          </a>
      </div>
        
    </div>
    </div>
</footer>
	</body>
</html>