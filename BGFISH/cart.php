<?php
	session_start();
	if(isset($_POST["add"])){
		if(isset($_SESSION["cart"])){
			$item_array_id = array_column($_SESSION["cart"],"product_id");
			var_dump($_SESSION["cart"]);
			
			if(!in_array($_POST["hidden_ID"],$item_array_id)){
				
				$count = count($_SESSION["cart"]);
				//var_dump($count);
				$item_array = array(
				'product_id' => $_POST["hidden_ID"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
				);
				$_SESSION["cart"][$count] = $item_array;
				//echo '<script>window.location="products.php"</script>';
			}else{
				echo 'test1';
				//echo '<script>window.location="Cart.php?alreadyAdded=true"</script>';
			}
		}else{
			echo 'test2';
            $item_array = array(
                'product_id' => $_POST["hidden_ID"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
		}
		header("Location: shoppingCart.php");
	}
	
	if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="Cart.php"</script>';
					header("Location: shoppingCart.php");
                }
            }
        }
    }
	require_once("conn/Conn.php");
?>