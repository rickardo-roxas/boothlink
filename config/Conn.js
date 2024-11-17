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

conn.connect((err) => {

    if (err) {
        console.log("Connection error: ", err.stack);
        return;
    }
});


function closeConnection() {
    conn.end((err) => {
        if (err) {
            console.log(err);
            return
        }
    })
}

module.exports = {
    conn, 
    closeConnection
}
