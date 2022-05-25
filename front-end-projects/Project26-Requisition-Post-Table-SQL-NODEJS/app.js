const express = require('express');
const app = express();
const mysql = require('mysql');

const bodyparser = require('body-parser');
const path = require('path');

app.listen('3000',()=>{
	console.log("Servidor rodando 2!");
});

//Body Parser
app.set('view engine','ejs');
app.set('views',path.join(__dirname,'views'));
app.use(bodyparser.json());
app.use(bodyparser.urlencoded({extended:false}));
app.use(express.static(path.join(__dirname,'public')));

//Connection with the bank
const db = mysql.createConnection({
	host:'localhost',
	user:'root',
	password:'',
	database:'node'
});

db.connect(function(err){
	if(err)
	{
		console.log("It could not connect to the bank!");
	}
})

app.get('/',function(req,res){
	let query = db.query("SELECT * FROM customers",function(err,results){
		res.render('index',{list:results});
	})
	
});


app.get('/register',function(req,res){
	res.render('register',{});
})


app.post('/register',function(req,res){
	console.log("Registration successful!");
	let name = req.body.name;
	let surname = req.body.surname;
	let company = req.body.company;
	db.query("INSERT INTO customers (name,surname,company) VALUES (?,?,?)",[name,surname,company],function(err,results){});
	res.render('register',{});
})