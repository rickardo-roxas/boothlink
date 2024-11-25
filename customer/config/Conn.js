// SQL Connection
const sql = require('mysql2');

const conn = sql.createPool({
    host: "database",
    user: "root",
    password: "root",
    database: "boothlink",
    connectionLimit: 15,
    waitForConnections: true,
});


module.exports = {
    conn
}
