<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="home.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="menu.js"></script>
</head>
<body>
	<div id="header">
		<div class="x-logo"><img src="/agroGoldSeeds/logo.jpg" alt="logo"><a href="home.html"></a></div>
		<div class="x-menu">
			<span class="home"><a href="home.html">Home</a></span>
			<span class="product">Product</span>
			<span class="aboutUS"><a href="about.html">About US</a></span>
			<span class="contactUS"><a href="contact.html">Contact US</a></span>
		</div>
		<div class="x-subMenu">
			<span><a href="details.php">Cotton Hybrid</a></span>
			<span><a href="details.php">Jawar</a></span>
			<span><a href="details.php">Bajra</a></span>
			<span><a href="details.php">Paddy</a></span>
			<span><a href="details.php">Wheat</a></span>
			<span><a href="details.php">Tomato</a></span>
			<span><a href="details.php">Oil seeds</a></span>
		</div>
	</div>

<?php
	$con = mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db("registerationform") or die("Unable to access database");
		function getIp() {
		    $ip = $_SERVER['REMOTE_ADDR'];
		 
		    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }
		 
		    return $ip;
		}

	if (isset($_GET['add_cart'])) {
		

		//To get user IP

		$ip = getIp();
		// To get product ID

		$pro_id = $_GET['add_cart'];

		//Check product is already selected

		$check_product = "SELECT * FROM cart where ip_add = '$ip' AND p_id = '$pro_id'";
		$check_ip = "SELECT * FROM cart where ip_add = '$ip'";
		$check_cart = mysql_query($check_product) or die("unable to select cart");
		//$check_item = mysql_query($check_ip) or die("unable to select cart");
		//$total_item = mysql_num_rows($check_item);
		//echo $total_item;
		$total_price ='0';


		if(mysql_num_rows($check_cart)) {
			echo "";
		}
		else {
			$insert_product = "INSERT INTO cart (p_id,ip_add) VALUES ('$pro_id','$ip')";
			$run_cart = mysql_query($insert_product);
			//echo "<script>window.open('details.php','_self')</script>";

		}
			$check_item = mysql_query($check_ip) or die("unable to select cart");
			$total_item = mysql_num_rows($check_item);
			// To calculate Total price
			while ($price = mysql_fetch_array($check_item)) {
				$pro_id = $price['p_id'];
				$product_price = "SELECT * FROM products WHERE product_id='$pro_id'";
				$run_price = mysql_query($product_price) or die("Unable to find price");

				while ($product_total_price = mysql_fetch_array($run_price)) {
					$products_price = array($product_total_price['product_price']);
					$sum = array_sum($products_price);
					//echo $sum;
					$total_price += $sum;
					
				}
			}
			echo "

				<div class='total'> 
					<span class='totalItem'>Total Item:
						$total_item
					</span>
					<span class='price'> Total Price: $total_price</span>

				</div>
			";
	} 

	$get_pro = "SELECT * FROM products order by RAND()";

	$run_pro = mysql_query($get_pro) or die("unable to select product");
	#$row_pro = mysql_fetch_array($run_pro);

	while($row_pro = mysql_fetch_array($run_pro)) {
		$pro_id = $row_pro['product_id'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];

		echo "
			<div class='details'>
				<div class='item'>
					<div class='image'><img src='/agroGoldSeeds/images/$pro_image' width='140' height='140' border= '1px solid black'/></div>
					<div class='text'> Price: $ $pro_price<br/>
						$pro_desc
					</div>
					<a href='details.php?add_cart=$pro_id'><button class='buy'>Add To Cart</button></a>
				</div>
			</div>

		";
	}
	mysql_close();
?>
<button class="continue"><a href="registeration.html">Proceed to checkout</a></button>
</body>
</html>




