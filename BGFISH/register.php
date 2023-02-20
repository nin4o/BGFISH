<?php
	session_start();
	if(isset($_SESSION["user"])){
		header("Location: index.php");
	}
?>
<!Doctype html>
<html>
<head>
	<title>Регистрация | BG FISH</title>
	<link rel="stylesheet" href="styleRegister.css" type="text/css">
	<link rel="stylesheet" href="style1.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="body">

	<?php
		$exists = false;
		$errors = array();
		if(isset($_SESSION["errors"])){
			$exists = true;
			$errors = $_SESSION["errors"];
		}
	?>
	
	
	<ul>
  <li><a href="index.php">Начало</a></li>	
  <li><a href="about.php">За Нас</a></li>
  <li><a href="contact.php">Контакти</a></li>
  
  <li><input id="search" type="text" placeholder="Търси..."></li>
  <li><button id="searchButton" type="submit"><i class="fa fa-search"></i></button></li>
  
<?php
		
		
		
		
		
		if(isset ($_SESSION["user"])){
			
		echo '<li class="dropdown">';
		echo '<a href="editAccount.php"><i class="fa fa-fw fa-user"></i>'.$_SESSION["username"].'</a>';
		echo '<div class="dropdown-content">';
		
		echo	'<a href="editAccount.php">Профил</a>';
		echo	'<a href="conn/logout.php">Изход</a>';
		
		echo ' <li id="heart">
			<a href="favorites.php"><i class="fa fa-heart-o"></i></a>
			</li>
			<li id="cart">
			<a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
			</li>';
			
		}
		else{
			
		echo '<li class="dropdown">';
		echo '<a href="register.php"><i class="fa fa-fw fa-user"></i>Профил</a>';
		echo '<div class="dropdown-content">';
			
		echo '<div><a href="enter.php">Вход</a>
			 <a href="register.php">Регистрация</a>
			 </div>';
		echo '</li>';
		
		echo '<li id="heart">
			 <a href="enter.php"><i class="fa fa-heart-o"></i></a>
			 </li>
			 <li id="cart">
			 <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
			 </li>';
		}
      ?>
  

</ul><br><br>

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


	<form id="test" action="conn/reg.php" method="post">
		<div id="user">*Username: <br>
		<input type="text" name="username"> </div><br>
		<?php 
			if($exists && array_key_exists("username", $errors)){
				foreach($errors["username"] as $value){
					echo $value;
				}
			}
		?>
		<div id="email">*Имейл: <br>
		<input type="text" name="email"></div><br>
		<?php 
			if($exists && array_key_exists("email", $errors)){
				foreach($errors["email"] as $value){
					echo $value;
				}
			}
		?>
		<div id="pass">*Парола:<br>
		<input type="password" name="password"></div> <br>
		<?php 
			if($exists && array_key_exists("password", $errors)){
				foreach($errors["password"] as $value){
					echo $value;
				}
			}
		?>
		<div id="confPass">*Потвърди паролата:<br>
		<input type="password" name="confirmPassword"></div> <br>
		<?php 
			if($exists && array_key_exists("confirmPassword", $errors)){
				foreach($errors["confirmPassword"] as $value){
					echo $value;
				}
			}
		?><br>
		<input id="btnLog" type="submit" name="login" value="Регистрация">
	</form>
	
	
	<!-- Footer -->
<footer>
    <div id="footer-holder">
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
<?php 
$_SESSION["errors"] = NULL;
?>