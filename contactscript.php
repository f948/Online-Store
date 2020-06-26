<?php
				$firstname = trim($_POST["firstname"]);
				$lastname = trim($_POST["lastname"]);
				$email = trim($_POST["email"]);
				$topic = trim($_POST["topic"]);
				$subject = trim($_POST["subject"]);
				$message = trim($_POST["message"]);
			    $date=date("l jS \of F Y h:i:s A");
				
				$error_messages="";
				$i=0;
				
				// check first name
				if(empty($firstname)){
					$error_messages.="First name cannot be empty"."<br>";
				}
				
				// check last name
				if(empty($lastname)){
					$error_messages.="Last name cannot be empty"."<br>";
				}
				
				// check email 
				
				
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error_messages.="Invalid email address"."<br>";
				}
				
				// check message
				if(empty($message)){
					$error_messages.="Message must not be empty"."<br>";
				}
				
				// process messages 
				if ($error_messages==""){
					
					// enter data into mySQL database 
					$conn = mysqli_connect("localhost","root","","ecommerce");
					
					// conn failed 
					if(! $conn ) {
						die('Could not connect: ' . mysqli_error($conn));
					}
					
					$command="INSERT INTO `contacts`(`First Name`,`Last Name`,`Email`,`Topic`,`Subject`,`Message`,`Date`) VALUES('$firstname','$lastname','$email','$topic','$subject','$message','$date')";
				
					$query=mysqli_query($conn,$command);
					
					// query failed 
					if(! $query ) {
						die('Could not process request: ' . mysqli_error($conn));
					}
					
					print("Request processed");
				}
				else{
					print($error_messages);
				}
					
?>