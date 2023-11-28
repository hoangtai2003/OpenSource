<?php 
	session_start();
	//unset($_SESSION["cart_item"]);
	require_once("../connect.php");
	$sql="select a.*,b.cname from 0203466_Product_18 a,Categories b where a.cid=b.cid order by pid asc";
	$result=$conn->query($sql) or die($conn->error);
	//xử lý đối với giỏ hàng
	if (!empty($_GET["action"])){
		switch($_GET["action"]){
			case "add":
				if (!empty($_POST["quantity"])){
					$pid = $_GET["pid"];
					$product = $conn->query("select * from 0203466_Product_18 where pid=".$pid) or die($conn->error);
					$r[] = $product->fetch_assoc();
					$itemArray = 
						array($r[0]["code"]=>array(
							"pid"=>$r[0]["pid"],
							"pname"=>$r[0]["pname"],
							"code"=>$r[0]["code"],
							"pprice"=>$r[0]["pprice"],
							"pquantity"=>$_POST["quantity"],
							"pimage"=>$r[0]["pimage"])
						);
					//var_dump($itemArray);
					/*
						"a3"=>("pid"=>3,"pname"=>"xxxx","code"=>"a3"....),
						"a4"=>("pid"=>4,"pname"=>"xxx","code"=>"a4".....).....
					*/
					if (!empty($_SESSION["cart_item"])){
						if (in_array($r[0]["code"], array_keys($_SESSION["cart_item"]))){
							foreach($_SESSION["cart_item"] as $k=>$v){
								if ($r[0]["code"]==$k){
									if (empty($_SESSION["cart_item"][$k]["pquantity"])){
										$_SESSION["cart_item"][$k]["pquantity"]= 0;
									}
									$_SESSION["cart_item"][$k]["pquantity"] +=$_POST["quantity"];
								}
								
							}	
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
						}
						
					} else {
						$_SESSION["cart_item"]=$itemArray;
					}
				}
				echo "<br>";
				//var_dump($_SESSION["cart_item"]);
				
				break;
			case "remove":
				if (!empty($_SESSION["cart_item"])){
					foreach($_SESSION["cart_item"] as $k=>$v){
						if ($_GET["code"]==$k){
							unset($_SESSION["cart_item"][$k]);
						}
						if (empty($_SESSION["cart_item"])){
							unset($_SESSION["cart_item"]);
						}
					}
				}
				break;
			case "empty":
				unset($_SESSION["cart_item"]);
				break;
			
		}
	}
	
?>

<html>
	<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
			<div id="shopping-cart">
			<div class="txt-heading">Shopping Cart</div>
				<a id="btnEmpty" href="?action=empty">Empty Cart</a>
				<?php 
					$total_quantity = 0;
					$total_price = 0;
				?>
				<table class="tbl-cart" border = 1>
					<tr>
						<th>Name</th>
						<th>Code</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
						<th>Remove</th>
					</tr>
					<?php 
						if (!empty($_SESSION["cart_item"])){
							foreach($_SESSION["cart_item"] as $item){
								$item_price = $item["pquantity"]*$item["pprice"];
								?>
								<tr valign=middle>
									<td><img width=50px src="images/<?php echo $item["pimage"];?>" class="cart_item-image"><?php echo $item["pname"];?></td>
									<td><?php echo $item["code"];?></td>
									<td align=right><?php echo $item["pquantity"];?></td>
									<td align=right><?php echo $item["pprice"];?></td>
									<td align=right><?php echo "$".number_format($item_price,0);?></td>
									<td><a href="?action=remove&code=<?php echo $item["code"];?>">Remove</a></td>
								</tr>
								<?php 
								$total_quantity+=$item["pquantity"];
								$total_price +=$item_price;
							}
						}
					?>
					<tr>
						<td colspan=2>Total:</td>
						<td align=right><?php echo $total_quantity;?></td>
						<td></td>
						<td align=right><strong><?php echo "$".number_format($total_price,0);?></strong></td>
						<td></td>
					</tr>
				</table>
			</div>
			<div id="product-grid">
				<div class="txt-heading">Products</div>
				<?php if ($result->num_rows>0){
					while ($r = $result->fetch_assoc()){
				?>		
					<div class="product-item">
						<form method=POST action="?action=add&pid=<?php echo $r["pid"];?>">
							<div class="product-image"><img src="images/<?php echo $r["pimage"];?>" width=250px></div>
							<div class="product-tile-footer" style="background-color: #694b4b;">
								<div class="product-title"><?php echo $r["code"]."-".$r["pname"]."-".$r["cname"];?></div>
								<div class="product-price"><?php echo number_format($r["pprice"]);?>VND</div>
								<div class="cart-action"><input type=text class="product-quantity" name=quantity value=1 size=2>
								<input type=submit value="Add to Cart" class="btnAddAction"></div>
							</div>
						</form>
					</div>
				<?php
					}
				}
				?>
			</div>
			
			
	</body>
</html>