// SQL Connection
const sql = require('mysql');

const conn = sql.createConnection({
    host : "localhost",
    user : "root", 
    password : "",
    database: "boothlink"
});

