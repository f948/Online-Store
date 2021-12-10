var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var userData=[],purchases=[];
var purchaseId=0;
var adminPassword="Administrator@09";

const port = process.env.PORT || 3000
const months =["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

// go to home page
app.get('/', function (req, res) {
	

		res.sendfile("products.html");
	
});

// go to home page
app.get('/products.html', function (req, res) {
	
	
		res.sendfile("products.html");
	
	
});

// register for an account
app.get('/addAccount.html', function (req, res) {

		res.sendfile("addAccount.html");

});

// login into your account
app.get('/onlinestore.html', function (req, res) {

		res.sendfile("onlinestore.html");
	
});

// reset your username or password
app.get('/updateAccount.html', function (req, res) {

		res.sendfile("updateAccount.html");

	
});

// log into admin page
app.get('/administrator.html', function (req, res) {

		res.sendfile("administrator.html");
	
	
	
});

var result=[];
  
  result.push(['1', 'Dogs','Alberta','09/09/2012','https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.goodhousekeeping.com%2Flife%2Fpets%2Fadvice%2Fg1921%2Flarge-dog-breeds%2F&psig=AOvVaw2xX7Kzokg13-hb-Fef0miw&ust=1636681253215000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCIiU4PKWj_QCFQAAAAAdAAAAABAJ']);

  
  result.push(['2', 'Ontario','Ontario','09/06/2018','https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ontario.ca%2Fpage%2Fontario-place&psig=AOvVaw14cRbqhJXJHshFtmfTuaAP&ust=1636682212079000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCPDShvCaj_QCFQAAAAAdAAAAABAD']);
  
  result.push(['3', 'Cars','Africa','01/08/2002','https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.forbes.com%2Fsites%2Fjimgorzelany%2F2019%2F07%2F23%2Fhere-are-the-coolest-new-cars-for-2020%2F&psig=AOvVaw11rU1PLTld9dMDjHf1a4oI&ust=1636682361547000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCJC-iIObj_QCFQAAAAAdAAAAABAD']);
  
  
// if connection is recieved through socket check for data being sent 
io.on('connection', function(socket) {
	
	socket.on('event', function(){
		
		socket.emit("display1",result);
	
		socket.emit("display2",result);
	
		socket.emit("display3",result);
	});
	
	socket.on("validateRegisterInfo",function(data){
		
		var usernameExists=false;
		var passwordExists=false;
		var i;
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username == data.username){
				usernameExists=true;
			}
			if(userData[i].password == data.password){
				passwordExists=true;
			}
		}
		
		socket.emit("isRegisterInfoNew",{usernameStatus:usernameExists,passwordStatus:passwordExists});

	});
	
	socket.on("register",function(data){
		userData.push({username:data.username,password:data.password,address:data.address,code:data.code,balence:0});
		
	});
	
	socket.on("sendBalence",function(username){
		
		var i;
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username == username){
				
				socket.emit("getBalence",userData[i].balence);
			}
			
		}
		
	});
	
	socket.on("validateLoginInfo",function(data){
		
		var login=false;
		var i;
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username==data.username && userData[i].password==data.password){
				login=true;
			}
		}
		
		socket.emit("login",login);
	});
		
	socket.on("update",function(data){
		
		var i;
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username==data.oldUsername && userData[i].password==data.oldPassword){
				userData[i].username=data.newUsername;
				userData[i].password=data.newPassword;
				userData[i].address=data.newAddress;
				userData[i].code=data.newCode;
			}
		}
	});
	
	socket.on("updateBalence",function(payment){
		
		var i;
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username == payment.username){
				
				userData[i].balence=payment.balence;
			}
			
		}
	});
	
	socket.on("logPurchase",function(data){
		
		var i;
		var time,hours,minutes;
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username == data.username){
				
				data.date = new Date(data.date);
			
				if(data.date.getHours()+1 < 13){
				
					hours=data.date.getHours();
					time=" am";
				}
			
				else if(data.date.getHours()+1 >= 13){
					hours=data.date.getHours()-12;
					time=" pm";
				}
			
				if(data.date.getMinutes() < 10){
					minutes="0"+data.date.getMinutes();
				}
			
				else if(data.date.getMinutes() >= 10){
					minutes=data.date.getMinutes();
				}
		
				purchases.push({username:userData[i].username,address:userData[i].address,code:userData[i].code,products:data.products,total:data.total,date:months[data.date.getMonth()]+" "+data.date.getDate().toString()+", "+data.date.getFullYear().toString()+" at "+hours+":"+minutes+time,id:purchaseId,userDeleted:false,administratorDeleted:false});
				io.sockets.emit("getPurchase",{username:userData[i].username,address:userData[i].address,code:userData[i].code,products:data.products,total:data.total,date:months[data.date.getMonth()]+" "+data.date.getDate().toString()+", "+data.date.getFullYear().toString()+" at "+hours+":"+minutes+time,id:purchaseId,userDeleted:false,administratorDeleted:false});
				purchaseId++;
			}
		}
	});
	
	socket.on("getPurchases",function(){
		
		var i;
		
		for(i=0;i<=purchases.length-1;i++){

			io.sockets.emit("getPurchase",purchases[i]);

		}
	});
	
	
	socket.on("changePurchases",function(data){
		
		var i;
		
		for(i=0;i<=purchases.length-1;i++){
			if(purchases[i].username == data.oldUsername){
				purchases[i].username=data.newUsername;
				purchases[i].address=data.newAddress;
				purchases[i].code=data.newCode;
			}
		}
		
		
		
		io.sockets.emit("purchasesUpdated",purchases);
		
	});
	
	socket.on("userDelete",function(id){	
		
		var i;
		
		for(i=0;i<=purchases.length-1;i++){
			
			if(purchases[i].id==id){
				purchases[i].userDeleted=true;
			}
		}
		
		io.sockets.emit("purchasesUpdated",purchases);
		
	});
	
	socket.on("administratorDelete",function(id){	
		
		var i;
		
		for(i=0;i<=purchases.length-1;i++){
			
			if(purchases[i].id==id){
				purchases[i].administratorDeleted=true;
			}
		}
		
		io.sockets.emit("purchasesUpdated",purchases);
		
	});
	socket.on("sendAdminPassword",function(){
		socket.emit("getAdminPassword",adminPassword);
	});
	
	socket.on("changeAdminPassword",function(passwd){
		
		adminPassword=passwd;
		io.sockets.emit("getAdminPassword",adminPassword);
		
	});
});
	
http.listen(port, function() {
   console.log('listening on localhost:'+port);
});