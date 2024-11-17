// SQL Connection
const sql = require('mysql');

const conn = sql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "boothlink"
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
