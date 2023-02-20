<?php
	session_start();
	//$user =$_SESSION["user"];
?>
<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>BG FISH</title>
		
		 <link rel="stylesheet" href="style1.css">
		 <link rel="stylesheet" href="slideshow.css">
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
  <a href="shoppingCart.php"><i class="fa fa-shopping-cart"></i></a>
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

 <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 5</div>
            <img src="images/BadDay.jpg" style="width:100%">
            <div class="text">Fishing quotes</div>
          </div>
          
          <div class="mySlides fade">
            <div class="numbertext">2 / 5</div>
            <img src="images/FineLine.jpg" style="width:100%">
            <div class="text">Fishing quotes</div>
          </div>
          
          <div class="mySlides fade">
            <div class="numbertext">3 / 5</div>
            <img src="images/FishHappy.jpg" style="width:100%">
            <div class="text">Fishing quotes</div>
          </div>

          <div class="mySlides fade">
              <div class="numbertext">4 / 5</div>
              <img src="images/Fishing.jpg" style="width:100%">
              <div class="text">Fishing quotes</div>
            </div>
            
            <div class="mySlides fade">
              <div class="numbertext">5 / 5</div>
              <img src="images/FishingLive.jpg" style="width:100%">
              <div class="text">Fishing quotes</div>
            </div>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
      </div>
	<script>
    var slideIndex = 0;
    showSlides();
    
    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
           slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 5000); 
    }
    </script>
	
	<br>
	<div>ТОП продукти
	
	</div>

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
