<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="home.css">

</head>
<body>
<?php


@$dbConnect = new mysqli('localhost', 'root', '', 'registerationForm');
if (mysqli_connect_errno()) {
	echo ("<p>Error: Unable to connect to database.</p>" .
			"<p>Error code $dbConnect->connect_errno: $dbConnect->connect_error. </p>");
	exit;
	}
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];	
$state = $_POST['state'];
$country = $_POST['country'];
$zip = $_POST['zip'];
$mobile = $_POST['mobile'];    

if (!$fname || !$lname || !$address || !$city || !$state) {
    echo "<p>You have not entered all the required information. </p>";
    exit;
}

// add slashes if add and strip slashes default is not turned on
// magic_quotes_gpc is off by default in XAMPP, add \ if value contains a quote
if (!get_magic_quotes_gpc()){
	$fname = addslashes($fname); 
	$lname = addslashes($lname);
	$address = addslashes($address);
	$city = addslashes($city);
}

// insert into contact database
$sqlString = "INSERT into register values " .
				"(0,'$fname', '$lname','$email', '$address', '$city', '$state','$country','$zip','$mobile')";
$result = $dbConnect->query($sqlString);
if (!$result){	
	echo ("<p>Error: Contact information was not added.</p>" .
			"<p>Error code $dbConnect->errno: $dbConnect->error. </p>");
	header('Location:registeration.html');
	$dbConnect->close();
	exit;
	}

$dbConnect->close();
//** end of input processing
?>
<div id=header>
	<h1>Order Summary</h1>
</div>
<div class ="orderSummary">
<?php 

 mysql_connect("localhost", "root", "") or die(mysql_error()); 
 mysql_select_db("registerationform") or die("Unable to access database"); 
 $data = mysql_query("SELECT * FROM register order by ID desc") 
 or die("Unable to select data"); 
 #$info = mysql_fetch_array($data);

 while($info = mysql_fetch_array( $data )) 
 { 
 $Name = $info['fname']  ;
 $lname = $info['lname'];
 $address = $info['address'];
 $city = $info['city'];
 $state = $info['state'];
 $country = $info['country'];
 $zip = $info['zip'];
 $mobile = $info['mobile'];
 echo "
 	<div class='shipping'>
 		<h2> Shipping Details</h2>
 		Name:  $Name $lname<br/>
 		Address :  $address  $city $country<br/>
 		<pre>       $state- $zip</pre>
 		Mobile: $mobile


 	</div>
 ";
 } 

mysql_close();

?> 

<?php 

 mysql_connect("localhost", "root", "") or die(mysql_error()); 
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
		//To get user IP

		$ip = getIp();
		// To get product ID

		//$pro_id = $_GET['add_cart'];

		//Check product is already selected

		//$check_product = "SELECT * FROM cart where ip_add = '$ip' AND p_id = '$pro_id'";
		$check_ip = "SELECT * FROM cart where ip_add = '$ip'";
		//$check_cart = mysql_query($check_product) or die("unable to select cart");

		$total_price ='0';

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

				<div class='summary'> 
					<span class='totalItem'>Total Item:
						$total_item
					</span>
					<span class='price'> Total Price: $total_price</span>

				</div>
			";
	
 

mysql_close();

?> 
<div class="orderButton">
	<a href="home.html">
		<button class="signout" name="signout">Sign Out
			<?php
					mysql_connect("localhost", "root", "") or die(mysql_error()); 
			 		mysql_select_db("registerationform") or die("Unable to access database");
			 		 $data = mysql_query("SELECT * FROM register order by ID desc") 
			 		 or die("Unable to select data"); 
			 		 #$info = mysql_fetch_array($data);

					 while($info = mysql_fetch_array( $data )){
					 		$pID = $info['ID'];
					 	 		mysql_query("DELETE FROM `registerationform`.`register` WHERE `register`.`ID` = $pID");
					 }

						//mysql_connect("localhost", "root", "") or die(mysql_error()); 
				 		//mysql_select_db("registerationform") or die("Unable to access database");
						 $cart_data = mysql_query("SELECT * FROM cart order by p_id desc") 
				 		 or die("Unable to select data"); 
				 		 #$info = mysql_fetch_array($data);

						 while($info_cart = mysql_fetch_array( $cart_data )){
						 		$pID = $info_cart['p_id'];
						 	 		mysql_query("DELETE FROM `registerationform`.`cart` WHERE `cart`.`p_id` = $pID");
						 }


				 //DELETE FROM `registerationform`.`cart` WHERE `cart`.`p_id` = 1;		
			?>
		</button>
	</a>
	
</div>

</div>
</body>
</html>
