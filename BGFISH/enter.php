<?php
session_start();
	if(isset($_SESSION["user"])){
		header("Location: index.php");
	}
?>


<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Вход | BG FISH</title>
		
		 <link rel="stylesheet" href="style1.css" type="text/css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body id="body" >
	
	
		<ul>
  <li><a href="index.php">Начало</a></li>
  <li><a href="about.php">За Нас</a></li>
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
	
	<span id="enterORregister">ВХОД ИЛИ РЕГИСТРАЦИЯ</span><br><br><br><br>
	
	
	
	<span id="login">ВЛЕЗТЕ В ПРОФИЛА СИ</span>
	<span id="register">РЕГИСТРАЦИЯ</span></div><br><br>
	<form action="conn/login.php" method="post">
	
		<p id="regText"> Чрез регистрация ще имате достъп до онлайн пазаруване.<br><br>
		<button onclick = "location.href='register.php'" id ="reg" type="button">Регистрация</button>
		</p>
		
		<div id="divEmail">*Email: <br>
		<input id="test" type="text" name="email"></div><br>
		
		
		
		<div id="divPass">*Парола: <br>
		<input id="password" type="password" name="password">
		

		</div><br>
		
		<input id="btnLog" type="submit" name="login" value="Вход">
	</form>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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









