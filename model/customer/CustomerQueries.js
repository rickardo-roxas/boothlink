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

/** Shop Queries */

/** Method to get booths, and their associated images */
function getBooths() {
    const query = "SELECT organization.org_name and organization.org_img FROM organization"

    conn.query(query, (err, results)=> {
        if (err) {
            console.log(err);
            return callback(err, null);
        }
        callback(null,results);
    })
}

/** Method to get prod_id, category, name, price, description, img 
 *      if item in stock
*/
function getShopProducts() {
    const query =  "SELECT prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name, prod_serv.price, " + 
        "prod_serv.description, prod_img.img_src FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " + 
        "WHERE prod_serv.status = 'In Stock'";

    conn.query(query, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Gets all in stock products sorting by price and accepts a boolean parameter that tells if the filtering 
 * should be done descending or ascending  */
function getShopProductsByPrice(desc) {
    var query =  "SELECT prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name, prod_serv.price, " + 
    "prod_serv.description, prod_img.img_src FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " + 
    "WHERE prod_serv.status = 'In Stock' ORDER BY prod_serv.price ";
     
    if (desc) query += "DESC"; // Not sure if this is allowed

    conn.query(query, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Gets all in stock products, filtering based on category provided as parameter. 
 *      Possible Parameters: ITEM, SERVICE, FOOD */
function getShopProductsByPrice(category) {
    var query =  "SELECT prod_serv.prod_id, prod_serv.prod_serv_name, prod_serv.price, " + 
    "prod_serv.description, prod_img.img_src FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " + 
    "WHERE prod_serv.category = '?' ";

    conn.query(query, category, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** When an item gets clicked, the param data will include the product ID which will then be used to populate 
 * the product clicked view through this method
 * Output will include sched id, which will be used to get the schedule of the product in the same view.
 *  */
function getProductByID(id) {
    var query =  "SELECT organization.org_id, organization.org_name, organization.org_img, prod_serv.category, " +
    "prod_serv.prod_serv_name, prod_serv.price, prod_serv.description, prod_img.img_src, prod_org_sched.sched_id FROM prod_serv " +  
	" JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " + 
    " JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " + 
    " JOIN organization ON prod_org_sched.org_id = organization.org_id " + 
    "WHERE prod_serv.prod_id = '?'";

    conn.query(query, id, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Method to get the schedule and Location a product is being sold given its schedule ID */
function getScheduleByScheduleID(id) {
    var query = "SELECT location.loc_room, location.stall_number, schedule.date, schedule.start_time, schedule.end_time " + 
	    "FROM schedule JOIN location ON location.loc_id = schedule.loc_id " +
        "WHERE schedule.sched_id = ?";
        
    conn.query(query, id, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}




module.exports = {
    getFirstName,
    getLastName
}