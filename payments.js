var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var userData=[],purchases=[];
var i,purchaseId=0,connectedUsers=0;
var usernameExists=false,passwordExists=false,login=false,userExists=false;
var adminPassword="Administrator@09";

const port = process.env.PORT || 3000

// go to home page
app.get('/', function (req, res) {
	
	if(connectedUsers<50){
		res.sendfile("products.html");
	}
	else if(connectedUsers>=50){
		res.send("Too many connected users");
	}
});

// go to home page
app.get('/products.html', function (req, res) {
	
	if(connectedUsers<50){
		res.sendfile("products.html");
	}
	else if(connectedUsers>=50){
		res.send("Too many connected users");
	}
});

// register for an account
app.get('/addAccount.html', function (req, res) {
	if(connectedUsers<50){
		res.sendfile("addAccount.html");
	}
	else if(connectedUsers>=50){
		res.send("Too many connected users");
	}
});

// login into your account
app.get('/onlinestore.html', function (req, res) {
	if(connectedUsers<50){
		res.sendfile("onlinestore.html");
	}
	else if(connectedUsers>=50){
		res.send("Too many connected users");
	}
});

// reset your username or password
app.get('/updateAccount.html', function (req, res) {
	if(connectedUsers<50){
		res.sendfile("updateAccount.html");
	}
	else if(connectedUsers>=50){
		res.send("Too many connected users");
	}
	
});

// log into admin page
app.get('/administrator.html', function (req, res) {
	if(connectedUsers<50){
		res.sendfile("administrator.html");
	}
	else if(connectedUsers>=50){
		res.send("Too many connected users");
	}
	
});

// if connection is recieved through socket check for data being sent 
io.on('connection', function(socket) {
	
	connectedUsers++;
	
	socket.on("disconnect",function(){
		connectedUsers--;
	});
	
	socket.on("validateRegisterInfo",function(data){
		
		usernameExists=false;
		passwordExists=false;
		
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
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username == username){
				
				socket.emit("getBalence",userData[i].balence);
			}
			
		}
		
	});
	
	socket.on("validateLoginInfo",function(data){
		
		login=false;
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username==data.username && userData[i].password==data.password){
				login=true;
			}
		}
		
		socket.emit("login",login);
	});
		
	socket.on("update",function(data){
		
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
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username == payment.username){
				
				userData[i].balence=payment.balence;
			}
			
		}
	});
	
	socket.on("logPurchase",function(data){
		
		for(i=0;i<=userData.length-1;i++){
			
			if(userData[i].username == data.username){
				purchases.push({username:userData[i].username,address:userData[i].address,code:userData[i].code,products:data.products,total:data.total,date:data.date,id:purchaseId,deleted:false});
				io.sockets.emit("getPurchase",{username:userData[i].username,address:userData[i].address,code:userData[i].code,products:data.products,total:data.total,date:data.date,id:purchaseId,deleted:false});
				purchaseId++;
			}
		}
	});
	
	socket.on("getPurchases",function(){
		
		for(i=0;i<=purchases.length-1;i++){

			io.sockets.emit("getPurchase",purchases[i]);

		}
	});
	
	
	socket.on("changePurchases",function(data){
		for(i=0;i<=purchases.length-1;i++){
			if(purchases[i].username == data.oldUsername){
				purchases[i].username=data.newUsername;
				purchases[i].address=data.newAddress;
				purchases[i].code=data.newCode;
			}
		}
		
		
		
		io.sockets.emit("purchasesUpdated",purchases);
		
	});
	
	socket.on("delete",function(id){	
		
		for(i=0;i<=purchases.length-1;i++){
			
			if(purchases[i].id==id){
				purchases[i].deleted=true;
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