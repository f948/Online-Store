<?php
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
				if(strlen($fname) == 0){
					$error_messages.="Name cannot be empty"."<br>";
				}
				
				// check email 
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error_messages.="Invalid email address"."<br>";
					}
				
				// check postal code 
				if(strlen($postal_code)==0){
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
?>