<html>
<head>
<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php
	session_start();
	require_once("conn/Conn.php");
	if(isset($_SESSION["user"])){
	if(empty($_SESSION["cart"])){
		echo'<div>Количката е празна</div>';
	}else{	
	
	 
	?>
	<div style="clear: both"></div>
        <h3 class="title2">Вашата количка</h3>
        <div class="table-responsive" id="table-responsive">
            <table class="table table-bordered" id="table">
            <tr>
                <th width="30%">Име на продукта</th>
                <th width="10%">Единична цена</th>
                <th width="13%">Брой</th>
                <th width="10%">Сума</th>
                <th width="17%">Премахни предмет</th>
            </tr>
		<?php	$total = 0;
	 foreach ($_SESSION["cart"] as $key => $value) {
		echo '';
	
		?>
			<tr>
			<td><?php echo $value["item_name"]; ?></td>
			<td><?php echo $value["product_price"]; ?> лв.</td>
            <td><?php echo $value["item_quantity"]; ?></td>
            
            <td>
            <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
             <td><a href="Cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Премахни</span></a></td>
                        </tr>
		<?php
		$total = $total + ($value["item_quantity"] * $value["product_price"]);		
	 }
		?>
			<tr>
                <td colspan="3" align="right">Обща цена</td>
                <th align="right"><?php echo number_format($total, 2); ?> лв.</th>
                <td></td>
                </tr>
			</table>
			
	<?php
		}
	}else{
		header ('Location: '. $_SERVER['HTTP_REFERER']);
	}
?>
	
</body>
</html>


