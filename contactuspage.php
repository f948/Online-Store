
<html>
<head>

<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}


input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width: 100%;
  }
}
/* Style the top navigation bar */
.navbar {
  overflow: hidden;
  background-color: #333;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

/* Right-aligned link */
.navbar a.right {
  float: right;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}
</style>
</head>
<body>

<div >
  <img width="1500" height="500" src="https://mibeep.com/wp-content/uploads/2018/04/online-store-MiBeep.png">
</div>
<div class="navbar">
  <a href="ecommercewebsite.php">Home</a>
  <a href="aboususpage.php">About Us</a>
</div>

<h3>Contact Form</h3>

<div class="container">
	<form method="POST" action="contactscript.php">
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" placeholder="Your name..">

    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" placeholder="Your last name..">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Your email here..">
	
	<label for="topic">Topic</label>
	<select id="topic" name="topic">
		<option value="Product Inquiry">Product Inquiry</option>
		<option value="General Feedback">General Feedback</option>
		<option value="Ask a Question">Ask a Question</option>
		<option value="Website Feedback">Website Feedback</option>
		<option value="Subscription Status">Subscription Status</option>
		<option value="Alerts Issue">Alerts Issue</option>
		<option value="Billing">Billing</option>
		<option value="Renewal">Renewal</option>
	</select>
    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" placeholder="Your subject here..">
	
	<label for="message">Message</label>
    <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>
	
    <input type="submit" value="Submit" >
	</form>
</div>
</body>
</html>