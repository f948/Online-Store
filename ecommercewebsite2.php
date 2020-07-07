
<?php
			if(isset($_POST["submit"])){
				$fname = trim($_POST["fname"]);
				$email = trim($_POST["email"]);
				$postal_code = trim($_POST["postal_code"]);
				$telephone = trim($_POST["telephone"]);
				$address = trim($_POST["address"]);
				$credit_card_number = trim($_POST["ccnum"]);
				$date=date("l jS \of F Y h:i:s A");
				$total=trim($_POST["total"]);
				
				$error_messages="";
				$i=0;
				
				// check name
				if(empty($fname)){
					$error_messages.="Name cannot be empty"."<br>";
				}
				
				// check email 
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error_messages.="Invalid email address"."<br>";
					}
				
				// check postal code 
				if(empty($postal_code)){
					$error_messages.="Postal code cannot be empty"."<br>";
					}
				if(strlen($postal_code)!=6){
					$error_messages.="Postal code must have 6 characters without spaces"."<br>";
					}
					
				for($i=0;$i<=strlen($postal_code)-1;$i++){
					
					if($i==0){
						if(!ctype_upper($postal_code[$i])){
							$error_messages.="First character in postal code must be an uppercase letter"."<br>";
							}
					}
					
					if($i==1){
						if(!is_numeric($postal_code[$i])){
							$error_messages.="Second character in postal code must be an integer"."<br>";
							}
					}
					if($i==2){
						if(!ctype_upper($postal_code[$i])){
							$error_messages.="Third character in postal code must be an uppercase letter"."<br>";
							}
					}
					
					if($i==3){
						if(!is_numeric($postal_code[$i])){
							$error_messages.="Fourth character in postal code must be an integer"."<br>";
							}
					}
					
					if($i==4){
						if(!ctype_upper($postal_code[$i])){
							$error_messages.="Fifth character in postal code must be an uppercase letter"."<br>";
							}
					}
					
					if($i==5){
						if(!is_numeric($postal_code[$i])){
							$error_messages.="Sixth character in postal code must be an integer"."<br>";
							}
					}
				}
				// check telephone number 
				for($i=0;$i<=strlen($telephone)-1;$i++){
					
					if($i==0){
						if($telephone[$i] !="1"){
							$error_messages.="Telephone number must start with a 1"."<br>";
							}
					}
					
					if($i==1){
						if($telephone[$i] !="-"){
							$error_messages.="Second characer in telephone nunber must be a -"."<br>";
							}
					}
					if($i==2){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Third character in telephone number must be an integer"."<br>";
						}
					}
					
					if($i==3){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Fourth character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==4){
						if(!is_numeric($telephone[$i])){
						$error_messages.="Fifth character in telephone number must be an integer"."<br>";
						}
					}
					
					if($i==5){
						if($telephone[$i] !="-"){
							$error_messages.="Sixth characer in telephone nunber must be a -"."<br>";
							}
					}
					
					if($i==6){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Seventh character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==7){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Eighth character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==8){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Ninth character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==9){
						if($telephone[$i] !="-"){
							$error_messages.="Tenth characer in telephone nunber must be a -"."<br>";
							}
					}
					
					if($i==10){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Seventh character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==11){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Eleventh character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==12){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Twelth character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==13){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Thirteenth character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==14){
						if(!is_numeric($telephone[$i])){
							$error_messages.="Last character in telephone number must be an integer"."<br>";
							}
					}
					
					if($i==15){
						if ($telephone[$i]!="-"){
							$error_messages.="Telephone numbers must have a -"."<br>";
							}
					}
					
				}
				
				if (strlen($telephone)==14){
					$error_messages.="Telephone numbers must have 14 characters without spaces"."<br>";
				}
				
				// check address
				if(empty($address)){
					$error_messages.="Address must not be empty".'\n';
				}
				
				// check credit card number
				if(strlen($credit_card_number)){
					$error_messages.="Credit card number must be 16 characters long"."<br>";
				}
				
				// all characters must be digits
				for($i=0;$i<=strlen($credit_card_number)-1;$i++){
					
					if(!is_numeric($credit_card_number[$i])){
						$error_messages.="All characters in credit card number must be digits"."<br>";
					}
				
				}
				

				// process messages 
				if ($error_messages!=""){
					
					// enter data into mySQL database 
					$conn = mysqli_connect("localhost","root","","ecommerce");
					
					// conn failed 
					if(! $conn ) {
						die('Could not connect: ' . mysqli_error($conn));
					}
					
					$command="INSERT INTO `payments`(`Full Name`,`Email`,`Address`,`Telephone`,`Postal Code`,`Credit card number`,`Date`,`Total`) VALUES('$fname','$email','$postal_code','$telephone','$postal_code','$credit_card_number','$date','$total')";
				
					$query=mysqli_query($conn,$command);
					
					// conn failed 
					if(!$query ) {
						die('Could not insert data: ' . mysqli_error($conn));
					}
					
					print("Payment processed");
					
				}
				
				else{
					print($error_messages);
				}
			}
?>

<html>
<head>
<style>

.div {
  text-align: center;
}

.addToCartBtn {
  padding: 10px;
  width: 25%;
  background: lightgreen;
  color:black;
  float: left;
  text-align: center;
  font-size: 16px;
  font-family:arial;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
}

p {
  color: black;
  font-size:20px;
  font-family:arial;
  font-weight: bold;
}


.checkoutbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 4px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.checkoutbtn:hover {
  opacity: 1;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;

}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}

.navbar {
  overflow: hidden;
  background-color: black;
}
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

#table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

}

#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

</style>
</head>
<body>
	
<canvas width="1400" height="200" id="header">
	<img width="0" height="0" id="headerimage"src="https://mibeep.com/wp-content/uploads/2018/04/online-store-MiBeep.png">
</canvas>
<div class="navbar">
  <a href="aboususpage2.php">About Us</a>
  <a href="contactuspage2.php">Contact Us</a>
</div>
<canvas width="1400" height="600" id="canvas">
	<img width="0" height="0" id="1"src="https://static.squarespace.com/static/54ac8edce4b0ab38fef6ce47/54ac9ca8e4b0d2139d1c56b2/54ac9cfbe4b0d2139d1c6a27/1420598523644/candy.jpg?format=original">
	<img width="0" height="0" id="2"src="https://koa.com/blog/images/camping-vacation.jpg?preset=blogPhoto">
	<img width="0" height="0" id="3"src="https://static.techspot.com/images2/news/bigimage/2019/05/2019-05-11-image-6.jpg">
	<img width="0" height="0" id="4"src="https://www.canadianbusiness.com/wp-content/uploads/2016/01/walmart-low-prices-every-day-sign-459295906-andrew-francis-wallace-toronto-star-getty-compressor.jpg">
	<img width="0" height="0" id="5"src="https://d33x6c2gojonez.cloudfront.net/wp-content/uploads/sites/5872/2019/02/21110631/Why-Won%E2%80%99t-People-Buy-lots-of-stuff-from-me-in-my-business.jpg">
	<img width="0" height="0" id="6" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQPCJbo0s4zbvTd53UrskW7-isPmmOtvmDsG8x6VgwaKR7LscS-&usqp=CAU">
</canvas>
<div class="navbar">
</div>
	<table>
	<tr>
	<td><div class="div"><img src="data:image/jpeg;base64,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"width="250"height="210" name="1"></img><p name="1">Fidget Spinner</p><p>$1.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(1,1.99)">Add To Cart</span></div></td>
    <td><div class="div"><img src="https://lp2.hm.com/hmgoepprod?set=quality[79],source[/51/a3/51a3468c3083e862d0f486610f14d9849e54e137.jpg],origin[dam],category[men_jeans_skinny],type[DESCRIPTIVESTILLLIFE],res[m],hmver[1]&call=url[file:/product/main]"width="250"height="210" name="2"> </img><p name="2">Jeans</p><p>$39.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(2,39.99)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://ae01.alicdn.com/kf/HTB1s.IhSpXXXXbGXFXXq6xXFXXX5.jpg"width="250"height="210" name="3"> </img><p name="3">Yo Yo</p><p>$4.30</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(3,4.30)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcRkMyS7pXT7TG3JqkFt9sboVwjxpS_OKJqZjYDCxSW9vk-_SNE9tMCExDufgKZLuodlYEibwvo5TyVJHelf0Z4MsXrW_xsZ1pXQmXBRwYU&usqp=CAc"width="250"height="210" name="4"> </img><p name="4">TV Stand</p><p>$155.99</p><span class="addToCartBtn" style="width:250px;height:25px" id="155.99"onclick="addToCart(4,155.99)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcT0rkkKyrcBkXegKqALrjFSw1Y1GQIYTD41U51Ga91q_XyUWgbiU007WJwWLRbpc0uySE4DgDWNo78&usqp=CAc"width="250"height="210" name="5"> </img><p name="5">Milk Chocolate</p><p>$2.59</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(5,2.59)">Add To Cart</span></div></td>
  </tr>
  <tr>
	 <td><div class="div"><img src="https://dyw7ncnq1en5l.cloudfront.net/optim/produits/71/21659/apple-iphone-6-plus_5a7fc7ecdc58715d__450_400.png"width="250"height="210" name="6"> </img><p name="6">iPhone 6 plus</p><p>$942.49</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(6,942.49)">Add To Cart</span></div></td>
     <td><div class="div"><img src="https://i5.walmartimages.ca/images/Enlarge/278/972/6000200278972.jpg"width="250"height="210" name="7"> </img><p name="7">Android Tablet</p><p>$148.00</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(7,148.00)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://i5.walmartimages.ca/images/Enlarge/385/470/6000200385470.jpg"width="250"height="210" name="8"> </img><p name="8">HP 14 ChromeBook</p><p>$399.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(8,399.99)">Add To Cart</span></div></td>
	 <td><div class="div"><img src="https://storage.pizzapizza.ca/phx2/ppl_images/category/en/2x/pickup_speciala.png"width="250"height="210" name="9"> </img><p name="9">Medium Pepperoni Pizza</p><p>$7.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(9,7.99)">Add To Cart</span></div></td>
	 <td><div class="div"><img src="https://i5.walmartimages.com/asr/72265821-cfb5-4ddc-8752-695027267004_1.f4b34bad9aafd98caaaf4eae4bc24c60.jpeg"width="250"height="210" name="10"> </img><p name="10">2L Coca Cola</p><p>$1.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(10,1.99)">Add To Cart</span></div></td>
  </tr>
  <tr>
	 <td><div class="div"><img src="https://images.lululemon.com/is/image/lululemon/LU9AFAS_031382_1?$pdp_image_carousel$&wid=1080&op_usm=0.5,2,10,0&fmt=webp&qlt=90,1&op_sharpen=0&resMode=sharp2&iccEmbed=0&printRes=72"width="250"height="210" name="11"> </img><p name="11">BackPack</p><p>$98.00</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(11,98.00)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSuNkV0j76Mrn3kC7H3f9ieu1lK3wL_0SD_gESpxEBJVUU7qCIE_wEev35_T3qLFvTEM5wKh64PYg&usqp=CAc"width="250"height="210" name="12"> </img><p name="12">Samsung 8K QLED Smart TV</p><p>$4499.98</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(12,4499.98)">Add To Cart</span></div></td>
	 <td><div class="div"><img src="https://da.lowes.ca/webassets/images/651703_04280532_001_l.jpg"width="250"height="210" name="13"> </img><p name="13">Lawn Mower</p><p>$239.00</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(13,239.00)">Add To Cart</span></div></td>
    <td><div class="div"><img src="https://secure.img1-fg.wfcdn.com/im/17895068/resize-h800%5Ecompr-r85/4339/43397658/Cuisinart+14%2522+Portable+Charcoal+Grill.jpg"width="250"height="210" name="14"> </img><p name="14">Barbecue</p><p>$68.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(14,68.99)">Add To Cart</span></div></td>
	 <td><div class="div"><img src="https://fgl.scene7.com/is/image/FGLSportsLtd/FGL_332731212_99_b-GT-Avalanche-Sport-29-27-5-Mens-Mountain-Bike-2019-Gloss-Aqua-G27429M30?bgColor=0,0,0,0&fmt=png-alpha&hei=528&resMode=sharp&qlt=85,1&op_sharpen=1"width="250"height="210" name="15"> </img><p name="15">Bike</p><p>$759.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(15,759.99)">Add To Cart</span></div></td>
  </tr>
  <tr>
	<td><div class="div"><img src="https://secure.img1-fg.wfcdn.com/im/10462996/resize-h800%5Ecompr-r85/1041/104175892/Black+++Decker+Airswivel+Ultra+Light+Weight+Bagless+Upright+Vacuum.jpg"width="250"height="210"name="16"> </img><p name="16">Bike</p><p>$154.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(16,154.99)">Add To Cart</span></div></td>
    <td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQgvVkA4fO8XkRXdAgVF021fTR9mC5VUM4n2681VsYWgqA6jL3KQ65X_0PYsc4o9sNGUsl-PCA&usqp=CAc"width="250"height="210" name="17"> </img><p name="17">Broom and Dustpan</p><p>$44.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(17,44.99)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTUSlCZjIyy0Z8xhMrIJ4PqHZSTMVtSH0pimkSj-DZ732FieOznVNuYXWQQDRqJO_1_vKdqYmUL&usqp=CAc"width="250"height="210" name="18"> </img><p name="18">Microwave</p><p>$142.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(18,142.99)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTjFsaZt9er1RBAYnSLS418IITXXbQ3OeFSQf0XtfZ0iUMbs18oxhUAgRIY7e-d04q3V8APptI&usqp=CAc"width="250"height="210" name="19"> </img><p name="19">Computer Mouse</p><p>$39.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(19,39.99)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR0zBjBr-pcl08W4TE3iZLCoCITd9jR_gGk4-RPHYBksWVpXVoveYLSh0rYBAgMfHskNaJlNtw&usqp=CAc"width="250"height="210" name="20"> </img><p name="20">Camera</p><p>$479.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(20,479.99)">Add To Cart</span></div></td>
  </tr>
  <tr>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcT49FlfHIqMRwDobQUlggdOnYJH5CZgv0lEp5u4mRjjHQIj6e-CorRPu1jXm5RDLLvMZtefJd5l&usqp=CAc"width="250"height="210" name="21"> </img><p name="21">Computer KeyBoard</p><p>$99.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(21,99.99)">Add To Cart</span></div></td>
    <td><div class="div"><img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSNhuspwd89HsdiJ4S_01YILe6hvEplxqftJJU1Y7Og8ce9s3G6M8GjWOk2Sn0K67ZzYj3hZCZFXnI&usqp=CAc"width="250"height="210" name="22"> </img><p name="22">Rotating Fan</p><p>$79.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(22,79.99)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRMJk4U4hS0o_MmZNyfcCd3n_iTp8_aGOoHlCHjcoL4P4LR8cTt2IA6gIR5Ep1gg8A3uWLgBg&usqp=CAc"width="250"height="210" name="23"> </img><p name="23">Refrigerator</p><p>$2594.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(23,2594.99)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQl8ilYx9FjR9F7oN-G8Dl5UtKXhpLcwsm02glQ_7U96w2Vw4pgcjQZz61w-XUMXSzuGHy6gU9lpw&usqp=CAc"width="250"height="210" name="24"> </img><p name="24">Duct Tape</p><p>$23.60</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(24,23.60)">Add To Cart</span></div></td>
	 <td><div class="div"><img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSNhuspwd89HsdiJ4S_01YILe6hvEplxqftJJU1Y7Og8ce9s3G6M8GjWOk2Sn0K67ZzYj3hZCZFXnI&usqp=CAc"width="250"height="210" name="25"> </img><p name="25">Rotating Fan</p><p>$79.99</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(25,79.99)">Add To Cart</span></div></td>
  </tr>
  <tr>
	 <td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTESUF45EwRLO3G8VWixFNR_mVWh0Vnt8XoXWs0sgs0pG7c67OV8G-w0cP8wiA&usqp=CAc"width="250"height="210" name="26"> </img><p name="26">Blinds</p><p>$80.24</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(26,80.24)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR4dqBN8EuowjofQrUmG_btZGPwbVDPtiGbDEoYlfKRklPlQHVp9-JD9j3UgNpAeBZTlVzmKhk&usqp=CAc"width="250"height="210" name="27"> </img><p name="27">Dress</p><p>$32.12</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(27,32.12)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSAotWzzN5nCRYegNRh1WkrX9W-ynhZhDCmUqwZ5ZDffuaVhNzD2UVnMnBUekE&usqp=CAc"width="250"height="210" name="28"> </img><p name="28">Pencil Sharpener</p><p>$21.49</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(28,21.49)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://cdn11.bigcommerce.com/s-6108b/images/stencil/500x659/products/1694/2826/L501-sLeft__66866.1526756754.png?c=2&imbypass=on"width="250"height="210"name="29"> </img><p name="29">Color Printer</p><p>$3995.00</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(29,3995.00)">Add To Cart</span></div></td>
	<td><div class="div"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTJYuu7JpirsLfQb0jMyR65D2lITV2rlwsSlZPbx7f5Yc72Rd0cyFUp3XoI6CQ0uxxWT1_kNhg&usqp=CAc"width="250"height="210" name="30"> </img><p name="30">Coat</p><p>$115.50</p><span class="addToCartBtn" style="width:250px;height:25px" onclick="addToCart(30,115.50)">Add To Cart</span></div></td>
 </tr>
  </table>
  <br>
  <table id="table" >
  <tr>
	<th>Item</th>
	<th>Item Image</th>
    <th>Quantity</th>
	<th>Price</th>
	<th></th>
	<th></th>
  </tr>
</table>
<form method="POST" action="ecommercewebsite2.php">
	<input type="text" id="total" name="total" value="$"readonly>
				
<div class="row">
  <div class="col-75">
    <div class="container">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="address"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="address" name="address" placeholder="542 W. 15th Street">
            <label for="telephone"><i class="fa fa-institution"></i> Telephone</label>
            <input type="text" id="telephone" name="telephone" placeholder="123-456-7898">
              <div class="col-50">
                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" placeholder="2M45J6">
              </div>
            </div>
          </div>
          <div class="col-50">
            <h3>Payment</h3>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="ccnum" placeholder="1111222233334444">
          </div>
        </div>

        <input type="submit" id="submit"name="submit"value="Checkout" class="btn" >
    </div>
  </div>
</div>
</form>	
				
<script>

	var totalAmount=0,element,num=1,image,quantity=1;
	
	// global constants 
	const header = document.getElementById("header");
	const headerContext=header.getContext('2d');
	const headerImage = document.getElementById("headerimage");
	const table = document.getElementById("table");
	const total = document.getElementById("total");
	const canvas = document.getElementById("canvas");
	const context = canvas.getContext('2d');
	
	
	function init(){
		
		
		context.fillStyle="white";
		context.font = "bolder 65px Arial";
		headerContext.drawImage(headerImage,0,0,500,200);
		setInterval(changeSlide,2000);
	}
	
	function changeSlide(){
		
		// change slide number
		num++
		
		if(num == 7){
			num=1;
		}
		
		// slide #1
		if(num == 1){
			image = document.getElementById(num.toString());
			context.drawImage(image,0,0,canvas.width,canvas.height);
			
		
			context.fillText("Buy lots of candy this halloween",100,100);
		}
		
		// slide #2
		else if(num == 2){
			image = document.getElementById(num.toString());
			context.drawImage(image,0,0,canvas.width,canvas.height);
			

			context.fillText("Get ready for a vacation",100,100);
		}
		
		// slide #3
		else if(num == 3){
			image = document.getElementById(num.toString());
			context.drawImage(image,0,0,canvas.width,canvas.height);
			

			context.fillText("We offer home shipping",100,100);
		}
		// slide#4
		else if(num == 4){
			image = document.getElementById(num.toString());
			context.drawImage(image,0,0,canvas.width,canvas.height);

			context.fillText("Our prices are low",100,100);
		}
		// slide #5
		else if(num == 5){
			image = document.getElementById(num.toString());
			context.drawImage(image,0,0,canvas.width,canvas.height);
	
			context.fillText("There is just so much we sell",100,100);
		}
		// slide #6
		else if(num == 6){
			image = document.getElementById(num.toString());
			context.drawImage(image,0,0,canvas.width,canvas.height);
	
			context.fillText("Drone delivery is also included",100,100);
		}
	}
	
	function addToCart(name,price) {
		
		// create new row 
		var row = table.insertRow(1);
		
		var itemCell = row.insertCell(0);
		itemCell.setAttribute("width","50");
		itemCell.setAttribute("height","10");
		
		element = document.getElementsByName(name.toString())[1];
		itemCell.innerHTML=element.innerHTML;
		
		var imageCell = row.insertCell(1);
		imageCell.setAttribute("width","50");
		imageCell.setAttribute("height","10");
		
		var image = document.createElement("IMG");
		image.src=document.getElementsByName(name.toString())[0].src;
		image.setAttribute("width","100");
		image.setAttribute("height","100");
		imageCell.appendChild(image);
		
		var quantityCell = row.insertCell(2);
		quantityCell.setAttribute("width","50");
		quantityCell.setAttribute("height","10");
		quantityCell.innerHTML="1";
		
		var priceCell = row.insertCell(3);
		priceCell.setAttribute("width","50");
		priceCell.setAttribute("height","10");
		priceCell.innerHTML=price.toString();
		
		var addOrSubtractCell = row.insertCell(4);
		addOrSubtractCell.setAttribute("width","50");
		addOrSubtractCell.setAttribute("height","10");
		
		// create add button for addOrSubtractCell
		var addButton = document.createElement("BUTTON");
		addButton.innerHTML="Add";
		addButton.setAttribute("width","50");
		addButton.setAttribute("height","10");
		addOrSubtractCell.appendChild(addButton);
		
		// create subtract button for addOrSubtractCell
		var subtractButton = document.createElement("BUTTON");
		subtractButton.innerHTML="Subtract";
		subtractButton.setAttribute("width","50");
		subtractButton.setAttribute("height","10");
		addOrSubtractCell.appendChild(subtractButton);
		
		var removeCell = row.insertCell(5);
		removeCell.setAttribute("width","50");
		removeCell.setAttribute("height","10");
		
		// create button for removeCell
		var removeButton = document.createElement("BUTTON");
		removeButton.innerHTML="Remove";
		removeButton.setAttribute("width","50");
		removeButton.setAttribute("height","10");
		removeCell.appendChild(removeButton);
		
		// recalculate total 
		totalAmount+=Number(price);
		
		if(totalAmount<1){
			totalAmount=0;
		}
		
	   total.value="$"+totalAmount.toString();
		
		// add event listeners for each element
		
		// add item
		addButton.addEventListener("click",function(){
			
			// recalculate total 
			totalAmount+=Number(addButton.parentNode.parentNode.childNodes[3].innerHTML);
			
			total.value="$"+totalAmount.toString();
			
			quantity=Number(addButton.parentNode.parentNode.childNodes[2].innerHTML)+1;
			addButton.parentNode.parentNode.childNodes[2].innerHTML=quantity.toString();
			
			
		});
		
		// subtract item
		subtractButton.addEventListener("click",function(){
			
			if(quantity >1){
				
				// recalculate total 
				totalAmount-=Number(subtractButton.parentNode.parentNode.childNodes[3].innerHTML);
				total.value="$"+totalAmount.toString();
			
				quantity=Number(subtractButton.parentNode.parentNode.childNodes[2].innerHTML)-1;
				subtractButton.parentNode.parentNode.childNodes[2].innerHTML=quantity.toString();
			}
			
		});
	
		// remove task 
		removeButton.addEventListener("click",function(){
			
			// recalculate total 
			totalAmount-=Number(removeButton.parentNode.parentNode.childNodes[2].innerHTML)*Number(removeButton.parentNode.parentNode.childNodes[3].innerHTML);
			
			if(totalAmount<1){
				totalAmount=0;
			}
			
			total.value="$"+totalAmount.toString();
			
			removeButton.parentNode.parentNode.parentNode.removeChild(removeButton.parentNode.parentNode);
			
		});
	}
	
			
           
					
			window.onload=init;
	
</script>
</body>
</html>
