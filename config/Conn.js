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

function getFirstName(username, callback) {
    const query = "SELECT first_name FROM customer where username=?";

    conn.query(query, [username], (err, results) => {
        if (err) {
            console.log(err);
            return callback(err, null);
        }

        console.log(results);
        callback(null, results);
    })
}

function getLastName(username, callback) {
    const query = "SELECT last_name FROM customer where username=?";

    conn.query(query, [username], (err, results) => {
        if (err) {
            console.log(err);
            return callback(err, null);
        }

        console.log(results);
        callback(null, results);
    })
}

function closeConnection() {
    conn.end((err) => {
        if (err) {
            console.log(err);
            return
        }
    })
}

module.exports = {
    getFirstName,
    getLastName,
    closeConnection
}
