<?php 
	session_start();
	//unset($_SESSION["cart_item"]);
	require_once("../connect.php");
	$sql="select a.*,b.cname from 0203466_Product_18 a,Categories b where a.cid=b.cid order by pid asc";
	$result=$conn->query($sql) or die($conn->error);
	//xử lý đối với giỏ hàng
	if (!empty($_GET["action"])){
		switch($_GET["action"]){
			case "pay":
				// Lấy thông tin người nhận hàng từ bảng user
				$UserId = $_SESSION["UserId"];	
				$userInfoSql = "SELECT * FROM user WHERE uid = '$UserId'";
				$userInfoResult = mysqli_query($conn, $userInfoSql);
				if (mysqli_num_rows($userInfoResult) > 0) {
					$userInfo = mysqli_fetch_assoc($userInfoResult);
					$receiverName = $userInfo["username"];
					$receiverAddress = $userInfo["address"];
					$receiverEmail = $userInfo["email"];
					$receiverPhone = $userInfo["phone"];
				} 
				$paymentMethod = "Thanh toán khi nhận hàng";
				$ostatus = "Đã thanh toán";
				// Sau khi tính tổng giá trị đơn hàng và số lượng sản phẩm
				if (!empty($_SESSION["cart_item"])) {
					$total_quantity = 0;
					$total_price = 0;
			
					foreach ($_SESSION["cart_item"] as $item) {
						$total_quantity += $item["pquantity"];
						$total_price += $item["pquantity"] * $item["pprice"];
					}
			
					// Thực hiện câu truy vấn để lưu thông tin đơn hàng
					$orderSql = "INSERT INTO orders (userid, total_quantity, total_price, receiver_username, address, email, phone, payment_method, ostatus) VALUES ('$UserId', '$total_quantity', '$total_price', '$receiverName', '$receiverAddress', '$receiverEmail', '$receiverPhone', '$paymentMethod', '$ostatus')";
					mysqli_query($conn, $orderSql);
			
					// Lấy ID của đơn hàng vừa thêm vào
					$orderId = mysqli_insert_id($conn);
			
					// Lưu chi tiết đơn hàng
					foreach ($_SESSION["cart_item"] as $item) {
						$pid = $item["pid"];
						$quantity = $item["pquantity"];
						$price = $item["pprice"];
			
						$detailSql = "INSERT INTO orderdetail (oid, pid, quantity, price) VALUES ('$orderId', '$pid', '$quantity', '$price')";
						mysqli_query($conn, $detailSql);

						// Cập nhật lại số lượng trong bảng sản phẩm
						$updateProductQuantitySql = "UPDATE 0203466_Product_18 SET pquantity = pquantity - $quantity WHERE pid = '$pid'";
    					mysqli_query($conn, $updateProductQuantitySql);
					}
					if (isset($_SESSION['UserId'])){
						$checkCartid = "select * from cart  WHERE uid = '$UserId'";
						$resultCheckCartId = mysqli_query($conn, $checkCartid);
						$check = mysqli_fetch_assoc($resultCheckCartId);
						foreach ($_SESSION["cart_item"] as $cart_item) {
							$clearCartDetail = "DELETE FROM cartdetail WHERE CartId = '".$check['CartId']."'";
							mysqli_query($conn, $clearCartDetail);
						}
						$clearCartSql = "DELETE FROM cart WHERE uid = '$UserId'";
						mysqli_query($conn, $clearCartSql);
						// Xóa giỏ hàng sau khi thanh toán
						unset($_SESSION["cart_item"]);
					}
					
				}
				break;			
			case "add":
				if (!empty($_POST["quantity"]) && $_POST["quantity"] > 0){
					// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
					if (!isset($_SESSION["login"])) {
						header("Location: ../../login/login.php");
						exit(0);
					}
					$UserId = $_SESSION["UserId"];	
					$pid = $_GET["pid"];
					$product = $conn->query("select * from 0203466_Product_18 where pid=".$pid) or die($conn->error);
					$r[] = $product->fetch_assoc();
					if ($r[0]["pquantity"] >  0){
						$checkCartSql = "SELECT * FROM cart WHERE uid = '$UserId'";
						$checkCartResult = mysqli_query($conn, $checkCartSql);
			
						if (mysqli_num_rows($checkCartResult) == 0) {
							// Nếu người dùng chưa có giỏ hàng tạo một giỏ hàng
							$insertCartSql = "INSERT INTO cart (uid) VALUES ('$UserId')";
							mysqli_query($conn, $insertCartSql);
						}
						//$ItemArray đại diện cho một sản phẩm sẽ được thêm vào giỏ hàng , khóa chính là code
						$itemArray = array(
							$r[0]["code"] => array(
								"pid" => $r[0]["pid"],
								"pname" => $r[0]["pname"],
								"code" => $r[0]["code"],
								"pprice" => $r[0]["pprice"],
								"pquantity" => $_POST["quantity"],
								"pimage" => $r[0]["pimage"]
							)
						);

						// Lấy id giỏ hàng cho người dùng
						$getCartIdSql = "SELECT CartId FROM cart WHERE uid = '$UserId'";
						$getCartIdResult = mysqli_query($conn, $getCartIdSql);
						$cartIdRow = mysqli_fetch_assoc($getCartIdResult);
						$cartId = $cartIdRow['CartId'];
						$insertCartDetailSql = "INSERT INTO cartdetail (cartid, pid, quantity) VALUES ('$cartId', '$pid', '$_POST[quantity]')";
						mysqli_query($conn, $insertCartDetailSql);
						if (!empty($_SESSION["cart_item"])){
							if (in_array($r[0]["code"], array_keys($_SESSION["cart_item"]))){
							// in_array: kiểm tra xem 1 giá trị có tồn tại trong mảng hay không
							// array_keys : trả về một mảng chứa các khóa (keys) từ một mảng
							// $k là khóa (key) và $v là giá trị của mỗi phần tử trong mảng.
								foreach($_SESSION["cart_item"] as $k=>$v){
									if ($r[0]["code"]==$k){
										if (empty($_SESSION["cart_item"][$k]["pquantity"])){
											$_SESSION["cart_item"][$k]["pquantity"]= 0;
										}
										if ($r[0]["pquantity"] >= $_SESSION["cart_item"][$k]["pquantity"] + $_POST["quantity"]){
											$_SESSION["cart_item"][$k]["pquantity"] +=$_POST["quantity"];
										} else {
											?>
											<script>
												alert("Số lượng thêm vượt quá số lượng sẵn có");
											</script>
											<?php
										}
										
									}
								}	
							} else {
								$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
							}
							
						} else {
							$_SESSION["cart_item"]=$itemArray;
						}
					} else {
						?>
						<script>
							alert("Sản phẩm này đã hết hàng");
						</script>
						<?php
					}
					
				} else {
					?>
					<script>
						alert("Số lượng thêm vào không hợp lệ");
					</script>
					<?php
				}
				echo "<br>";
				
				break;
			case "remove":
				$pid = $_REQUEST["pid"];
				$UserId = $_SESSION["UserId"];
				
				if (!empty($_SESSION["cart_item"])) {
					foreach ($_SESSION["cart_item"] as $k => $v) {
						if ($_GET["code"] == $k) {
							$checkCartid = "select * from cart where uid = '$UserId'";
							$resultCheckCartId = mysqli_query($conn, $checkCartid);
							$check = mysqli_fetch_assoc($resultCheckCartId);
				
							if (isset($_SESSION["cart_item"]) && is_array($_SESSION["cart_item"])) {
								foreach ($_SESSION["cart_item"] as $item) {
									$clearCartDetail = "DELETE FROM cartdetail WHERE CartId = '" . $check['CartId'] . "' and pid = '" . $pid . "'";
									mysqli_query($conn, $clearCartDetail);
								}
								unset($_SESSION["cart_item"][$k]);
							}
						}
					}
					if (empty($_SESSION["cart_item"])) {
						unset($_SESSION["cart_item"]);
					}
				}
				
				break;
			case "empty":
				$UserId = $_SESSION["UserId"];
				$checkCartid = "select * from cart  WHERE uid = '$UserId'";
				$resultCheckCartId = mysqli_query($conn, $checkCartid);
				$check = mysqli_fetch_assoc($resultCheckCartId);
				// Kiểm tra xem giá trị được liên kết với khóa 'cart_item' có phải là một mảng hay không. 
				//Hàm is_array trả về true nếu biến được cung cấp là một mảng và ngược lại là false.
				if (isset($_SESSION["cart_item"]) && is_array($_SESSION["cart_item"])){
					foreach ($_SESSION["cart_item"] as $item) {
						$clearCartDetail = "DELETE FROM cartdetail WHERE CartId = '".$check['CartId']."'";
						mysqli_query($conn, $clearCartDetail);
					}
					$clearCartSql = "DELETE FROM cart WHERE uid = '$UserId'";
					mysqli_query($conn, $clearCartSql);
					unset($_SESSION["cart_item"]);
				}	

				break;
			case "logout":
				if (!empty($_GET["action"]) && $_GET["action"] == "logout") {
					unset($_SESSION['login']);
					header("Location: shoppingcart.php");
					exit();
				}
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
				<a id="btnPay" href="?action=pay">Thanh toán</a>
				<a id="btnEmpty" href="?action=empty">Empty Cart</a>
				<a id="btnLogout" href="?action=logout">Log out</a>
				<?php 
					$total_quantity = 0;
					$total_price = 0;
					// $UserId = $_SESSION["UserId"];
					// $cartQuery = "SELECT cd.*, p.* FROM cartdetail cd
					// JOIN 0203466_Product_18 p ON cd.pid = p.pid
					// WHERE cd.cartid IN (SELECT CartId FROM cart WHERE uid = '$UserId')";
	  				// $cartResult = $conn->query($cartQuery) or die($conn->error);
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
									<td><a href="?action=remove&code=<?php echo $item["code"];?>&pid=<?php echo $item["pid"];?> ">Remove</a></td>
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
				<?php if ($result->num_rows > 0){
					while ($r = $result->fetch_assoc()){
				?>		
					<div class="product-item">
						<form method=POST action="?action=add&pid=<?php echo $r["pid"];?>">
							<div class="product-image"><img src="images/<?php echo $r["pimage"];?>" width=250px></div>
							<div class="product-tile-footer" style="background-color: #694b4b;">
								<div class="product-title"><?php echo $r["code"]."-".$r["pname"]."-".$r["cname"];?></div>
								<div class="product-price"><?php echo number_format($r["pprice"]);?>VND</div>
								<div class="cart-action"><input type=text class="product-quantity" name=quantity value="1" size=2>
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