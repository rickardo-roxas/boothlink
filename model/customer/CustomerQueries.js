const db = require("../../config/Conn");
const conn = db.conn;

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

// Returns the reservations of a certain user
// DATA: Org Name, Item Name, Price, Date, Status, Quantity, and total price
function getReservations(username, callback){
    const query = "SELECT " + 
              "pi.img_src AS image_source, " + 
              "o.org_name, " + 
              "ps.prod_serv_name AS item_name, " + 
              "ps.category, " +  
              "ps.price, " + 
              "r.date, " + 
              "r.status, " + 
              "r.qty, " + 
              "(ps.price * r.qty) AS total_price " + 
              "FROM reservation r " + 
              "JOIN customer c ON r.customer_id = c.customer_id " + 
              "JOIN prod_serv ps ON r.prod_id = ps.prod_id " + 
              "JOIN prod_org_sched pos ON ps.prod_id = pos.prod_id " + 
              "JOIN organization o ON pos.org_id = o.org_id " + 
              "JOIN prod_img pi ON ps.prod_id = pi.prod_id " + 
              "WHERE c.username = ?;";
 

    conn.query(query, [username], (err, results) => {
        if(err){
            console.log(err);
            return callback(err, null);
        }else{
            return callback(null, results)
        }
    })
}

module.exports = {
    getFirstName,
    getLastName,
    getReservations
}