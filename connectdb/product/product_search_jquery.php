 <html>
	<head>
		<meta charset="utf-8">
		<style type="text/css">
		body{width:610px;}
		.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
		#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
		#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
		#country-list li:hover{background:#ece3d2;cursor: pointer;}
		#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
		</style>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			$("#search-box").keyup(function(){
				var keyword = $(this).val();
				$.ajax({
				type: "GET",
				url: "readProduct.php",
				data:{keyword: keyword},
				beforeSend: function(){
					$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
				success: function(data){
					$("#suggesstion-box").show();
					$("#suggesstion-box").html(data);
					$("#search-box").css("background","#FFF");
				}
				});
			});
		});
		
		function selectCountry(val) {
			$("#search-box").val(val);
			$("#suggesstion-box").hide();
		}
		
		</script>

		
	</head>
	<body>
		<body>
		<h1 align=center>List of Product</h1>
		<form name=f method=post>
		<div class="frmSearch">
			<input type=text name=search-box id="search-box" >
			<div id="suggesstion-box"></div>
			<input type=submit value="Search">
		</div>
		</form>	

		
	</body>
</html>