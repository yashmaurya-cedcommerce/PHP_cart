<?php
session_start();
if(!isset($_SESSION['cart']))
$_SESSION['cart']=array();


include 'config.php'; 


?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Products
	</title>
	<link href="addToCart_style.css" type="text/css" rel="stylesheet">
	<style>
		table{
			border: 2px solid black;
			border-collapse: collapse;
			width: 80%;
			margin-left: 10%;

		}
		td{
			border: 1px solid black;
			text-align: center;
			height: 30px;
			font-size: 20px
		}
		th{
			border: 1px solid black;
			background-color: #3e9cbf;
			height: 40px;
			font-size: 25px;
		}
		#clear{
			margin-left: 45%;
			font-size: 25px;

		}
	</style>
</head>
<body>
    <?php include 'products_header.php'; ?>
    

	<div id="main">
		<div id="products">
		<?php foreach($products as $key => $value)
            {

					$txt="<div id='".$value['id']."' class='product'>";
                    $txt = $txt."<img src =".$value['image'].">";
                    $txt = $txt."<h3 class='title'><a href='#'>Product ". $value['id']."</a></h3>";
                    $txt = $txt."<span>Price: $".$value['price']."</span>";
                    $txt = $txt."<a class='add-to-cart' href='addToCart_products.php?prod_id=".$value['id']."'>Add To Cart</a></div>";                   
					echo $txt;
            }
    		$cart_prod_id = $_GET['prod_id'];
			$cart_txt='';



	if(isset($_GET['prod_id']))
	{
		
		foreach($products as $key => $value)
		{
			if($cart_prod_id == $value['id'])
			{
				$flag=0;
				foreach($_SESSION['cart'] as $key_cart=>&$value_cart)
				{
					if($value_cart['id'] == $cart_prod_id)
					{
						$flag=1;
						$value_cart['quant']++;
					}
					// $new_prod = array($value['id'], $value['name'], $value['price'], $value['quantity']);
					// array_push($_SESSION['cart'], $new_prod);
					// print_arr($_SESSION['cart']);
				}
				if($flag==0)
				{
					$value['quant']++;
					array_push($_SESSION['cart'], $value);	
				}
			}

		}
		// echo "<pre>";
		// var_dump($_SESSION['cart']);
		// echo "</pre>";
		print_arr();
	}

			
			// print_r($_SESSION['cart']);
			function print_arr()
			{
				// print_r('Hello');
				$cart_txt="<table  class='cart_table'><tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Product Quantity</th></tr>";
				foreach($_SESSION['cart'] as $key=>$value)
				{
					// print_r($cart_products);
				$cart_txt .= "<tr><td>".$value['id']."</td><td>".$value['name']."</td><td>".$value['price']."</td><td>".$value['quant']."</td></tr>";
				}
				$cart_txt .= "</table>";
				echo $cart_txt;
			}
			if(isset($_GET['submit']))
			{
				echo "emptying";
				unset($_SESSION['cart']);
			}

		?>

		</div>
	</div>
	<!-- <a href='clear_cart.php' id='clear'>Clear Cart</button> -->
	<a href ='?submit=5' id='clear'>Clear Cart</a>
	<?php include 'products_footer.php'; ?>
</body>
</html>
