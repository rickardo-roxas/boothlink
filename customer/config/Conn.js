// SQL Connection
const sql = require('mysql');

const conn = sql.createPool({
    host: "localhost",
    user: "root",
    password: "",
    database: "boothlink",
    connectionLimit: 15,
    waitForConnections: true,
});


module.exports = {
    conn
}
