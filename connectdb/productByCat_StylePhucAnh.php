<?php
	require_once("connect.php");
	$sql = "SELECT * FROM 0203966_product_59 p INNER JOIN 0203966_category_59 c on c.cid = p.cid";
	$result = $conn->query($sql);
	$numProduct = $result->num_rows;
	function chiaTien($price){
		$str = "";
		$count = 0;
		for($i = strlen($price)-1; $i>=0; $i = $i - 1){
			$count = $count + 1;
			if($count%3 == 0){
				$str = $str . $price[$i] . "."; 
			}
			else{
				$str = $str . $price[$i];
			}
		}
		$str = strrev($str);
		if($str[0] == '.'){
			$str = substr($str, 1);
		}
		echo $str;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product By Category Style Phuc Anh</title>
	<style>
		ion-icon{
            margin: 0 auto;
            vertical-align: middle;
        }
		.product-list > li{
			min-height: 370px!important;
			position: relative;
		    cursor: pointer;
		    background: #fff;
		    overflow: hidden;
		    float: left;
		    width: 19.8%;
		    border-right: solid 1px #ddd;
		    border-bottom: solid 1px #ddd;
		    display: list-item;
    		text-align: -webkit-match-parent;
		}
		.product-list{
			overflow: hidden;
		    border-top: solid 1px #ddd;
		    border-left: solid 1px #ddd;
		}
		.product-list > ul{
			min-height: 200px;
		    display: flex;
		    flex-wrap: wrap;
		    padding: 0;
		    margin: 0;
		    list-style: none;
		}
		img{
			position: absolute;
			overflow-clip-margin: content-box;
    		overflow: clip;
    		max-width: 100%!important;
    		max-height: 290px;
    		width: auto;
    		left: 0;
		    right: 0;
		    top: 0;
		    bottom: 0;
		    margin: auto;
		}
		.img{
			display: block;
		    width: 100%;
		    position: relative;
		    padding-top: 100%;
		    
		}
		a{
			color: #333;
    		text-decoration: none;
		}
		.name{
			display: block;
			text-align: center;
			font-size: 20px;
		}
		.price{
			display: block;
			text-align: center;
		}
		.cate{
			display: block;
			text-align: center;
		}
		.add-to-cart{
			display: block;
		}
		.div-add-to-cart:hover{
			background-color: #DFFFFF;
		}
		.add-to-cart:hover{
			background-color: #DFFFFF;

		}
		.menu{
            border:1px ;    
            width:100%;
            box-shadow: 3px 3px 3px inset lightgray;
        }
        .menu > ul > li{
            display:inline-block;
            padding:15px 15px;
            color:blue;
        }
        .menu > ul > li > a{
            color:blue;
        }
        .menu  > ul > li:hover{
            background-color: floralwhite;
            box-shadow: 3px 3px 3px lightgreen;
        }
        .menu > ul > li > a{
            text-decoration: none;
        }
	</style>
</head>
<body>
	
		<?php
			$sql2 = "SELECT * FROM 0203966_category_59 order by cid";
			$result2 = $conn->query($sql2);
		?>
		<div class="menu">
			<ul>
				<li class="all"><a href="productByCat_StylePhucAnh.php">All Categories</a></li>
				<?php
					while($row2 = $result2->fetch_assoc()){
				?>
				<li class='<?php echo $row2["cname"];?>' ><a href='productByCat_StylePhucAnh.php?cid=<?php echo $row2["cid"];?>'><?php echo $row2["cname"];?></a></li>
				<?php
					}
				?>
			</ul>
		</div>
	<center>
		<h2>Danh sách sản phẩm</h2>
	</center>
	<br>
	<ul class="product-list">
		<?php
			if(isset($_GET["cid"])){
				$cid = $_GET["cid"];
				$sql = "SELECT * FROM 0203966_product_59 p INNER JOIN 0203966_category_59 c on c.cid = p.cid where p.cid = $cid";
				$result = $conn->query($sql);
			}
			if($result->num_rows == 0){
				echo "<script>alert('Không có sản phẩm!!!');</script>";
			}
			else{
				while($row = $result -> fetch_assoc()){
		?>
			<li class="product">
				<div>
					<a href='product_view.php?pid=<?php echo $row["pid"]?>' class="img"><img src='<?php echo $row["pimage"]?>' width="50px"></a>
					<a href='product_view.php?pid=<?php echo $row["pid"]?>' class="name"><i><b>Tên sản phẩm: </b></i><?php echo $row["pname"]?></a>
					<span class="cate"><i><b>Hãng: </b></i> <?php echo $row["cname"]?></span>
					<span class="price"><i><b style="color: red; font-weight:bold;">Giá Bán: </b></i><?php chiaTien($row["pprice"]);?><i>đ</i></span>
					
					<span class="status" style="float:right;margin-right: 25px;"><?php if($row["pstatus"] == 0) echo "<ion-icon style='color:green;' name='checkmark-outline'><i style='color:green;font-size:14px;'></ion-icon>Có hàng</i>"; else echo "<ion-icon style='color:red;' name='close-outline'></ion-icon><i style='color:red; font-size:14px;'>Hết hàng</i>"; ?></span>
					<?php
						if($row["pstatus"] == 0){

					?>
					<div class="div-add-to-cart"><a href="#" class="add-to-cart" style="font-size: 14px; margin-top:2px; float: left; margin-left: 25px;"><ion-icon name="cart-outline"></ion-icon>Thêm vào giỏ</a></div>
					<?php
						}
					?>
				</div>
			</li>
		<?php
			}
		}
		?>
	</ul>

	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>