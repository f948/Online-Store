<html lang="en">
<head>
<title>Page Title</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Style the body */
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

/* Header/logo Title */
.header {
  padding: 80px;
  text-align: center;
  background: #1abc9c;
  color: white;
}

/* Increase the font size of the heading */
.header h1 {
  font-size: 40px;
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

/* Column container */
.row {  
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  -ms-flex: 30%; /* IE10 */
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  -ms-flex: 70%; /* IE10 */
  flex: 70%;
  background-color: white;
  padding: 20px;
}

/* Fake image, just for this example */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width: 100%;
  }
}
</style>
</head>
<body>

<div >
  <img width="1500" height="500" src="https://mibeep.com/wp-content/uploads/2018/04/online-store-MiBeep.png">
</div>
<div class="navbar">
  <a href="ecommercewebsite.html">Home</a>
  <a href="contactuspage.html">Contact Us</a>
</div>
<div class="row">
  <div class="side">
    <h2>About Our Founder</h2>
    <h5>Jeff Bezos<h5>
    <img width="380" height="300" src="https://i.insider.com/5dee61fffd9db2526215e402?width=1100&format=jpeg&auto=webp">
    <p>Entrepreneur and e-commerce pioneer Jeff Bezos is the founder and CEO of the e-commerce company Amazon, owner of The Washington Post and founder of the space exploration company Blue Origin. His successful business ventures have made him one of the richest people in the world</p>
  </div>
  <div class="main">

    <h2>Amazon reaches 1 trillion market valuation</h2>
    <h5>Jan 31,2020</h5>
    <img width="900" height="300" src="https://ei.marketwatch.com/Multimedia/2018/07/19/Photos/ZQ/MW-GM819_amzn_a_20180719131518_ZQ.jpg?uuid=4f4b7a6c-8b77-11e8-9b0f-ac162d7bc1f7">
	<p>Search Results
Featured snippet from the web
After several close calls, Amazon AMZN, +1.71% officially became the fourth tech company to join the $1 trillion club Tuesday. Shares of Amazon increased 2.3% , to close at $1.021 trillion in market value, according to FactSet.</p>
	<h2>Amazon buys Ring for 1 billion</h2>
    <h5>Feb 22,2019</h5>
    <img width="900" height="300" src="https://res-4.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco/v1423003544/qqbbffvw62xhckv2ieza.jpg">
	<p>(Reuters) - Amazon.com Inc (AMZN. O) has agreed to buy video doorbell maker Ring, the companies said on Tuesday, in what analysts see as a growing bet on delivering packages inside of shoppers' homes and on home security. The deal valued Ring at more than $1 billion, a source familiar with the matter told Reuters.</p>
</div>

</body>
</html>