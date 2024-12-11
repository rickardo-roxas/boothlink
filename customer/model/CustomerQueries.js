const db = require("../config/Conn");
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
//debuggged shop view, converted product and booth view to ejs, modified customerqueries
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
/** Home Queries */

/** Method to get prod_id, category, name, price, description, img 
 *      if item in stock limited to five products
*/
function getFiveShopProducts(callback) {
    const query =  "SELECT DISTINCT organization.org_name AS organization, prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name AS 'name', prod_serv.price, " +
        " prod_serv.description, prod_img.img_src as 'image' FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " +
        " JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " + 
        " JOIN organization ON prod_org_sched.org_id = organization.org_id " + 
        " WHERE prod_serv.status = 'In Stock' LIMIT 5 ";

    conn.query(query, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Shop Queries */

/** Method to get booths, and their associated images */
function getBooths(callback) {
    const query = "SELECT org_id, organization.org_name, organization.org_img FROM organization";

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
function getShopProducts(callback) {
    const query =  "SELECT DISTINCT organization.org_name AS organization, prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name AS 'name', prod_serv.price, " +
        " prod_serv.description, prod_img.img_src as 'image' FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " +
        " JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " + 
        " JOIN organization ON prod_org_sched.org_id = organization.org_id " + 
        " WHERE prod_serv.status = 'In Stock' ";

    conn.query(query, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Method to get prod_id, category, name, price, description, img associated with an org if item in stock */

function getOrgProducts(orgID, callback) {
    const query = "SELECT DISTINCT prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name, prod_serv.price, " +
        "prod_serv.description, prod_img.img_src " + 
        "FROM prod_org_sched JOIN prod_serv ON prod_serv.prod_id = prod_org_sched.prod_id " + 
        "JOIN prod_img ON prod_img.prod_id = prod_serv.prod_id " + 
        "WHERE prod_org_sched.org_id = ? AND prod_serv.status = 'In Stock' ";

        conn.query(query, orgID, (err, results) => {
            if (err) {
                console.log(err);
                return callback(err,null);
            }
            callback(null,results);
        })
}
/** Gets all in stock products sorting by price and accepts a boolean parameter that tells if the filtering 
 * should be done descending or ascending  */
function getShopProductsByPrice(desc, callback) {
    var query =  "SELECT DISTINCT organization.org_name AS organization, prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name AS 'name', prod_serv.price, " +
    " prod_serv.description, prod_img.img_src as 'image' FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " +
    " LEFT JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " + 
    " LEFT JOIN organization ON prod_org_sched.org_id = organization.org_id " + 
    " WHERE prod_serv.status = 'In Stock' ORDER BY prod_serv.price ";

     
    if (desc) query = query + " DESC"; 

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
function getShopProductsByCategory(category, callback) {
    var query =  "SELECT DISTINCT organization.org_name AS organization, prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name AS 'name', prod_serv.price, " +
    " prod_serv.description, prod_img.img_src as 'image' FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " +
    " LEFT JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " + 
    " LEFT JOIN organization ON prod_org_sched.org_id = organization.org_id " + 
    " WHERE prod_serv.status = 'In Stock' and prod_serv.category= ? ";

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
function getProductByID(id, callback) {
    var query =  "SELECT organization.org_id AS 'id', organization.org_name, organization.org_img, prod_serv.category, " +
    "prod_serv.prod_serv_name, prod_serv.price, prod_serv.description, prod_img.img_src FROM prod_serv " +  
	" LEFT JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " +
    " LEFT JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " +
    " LEFT JOIN organization ON prod_org_sched.org_id = organization.org_id " +
    "WHERE prod_serv.prod_id = ?";

    conn.query(query, id, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results[0]);
    });
}

/** Method to get the schedule and Location a product is being sold given its schedule ID */
function getSchedulesByProductID(id, callback) {
    var query = "SELECT prod_org_sched.sched_id, location.loc_room, location.stall_number, schedule.date, schedule.start_time, schedule.end_time " +
	    "FROM schedule JOIN location ON location.loc_id = schedule.loc_id " +
        " JOIN prod_org_sched ON schedule.sched_id = prod_org_sched.sched_id " +
        " WHERE prod_org_sched.prod_id = ? ";
    conn.query(query, id, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Method to get booth, its associated image, and social links */
function getBoothData(id, callback) {
    const query = "SELECT organization.org_name, organization.org_img, " + 
    "organization.fb_link, organization.x_link, organization.ig_link FROM organization WHERE organization.org_id = ?";

    conn.query(query, id, (err, results)=> {
        if (err) {
            console.log(err);
            return callback(err, null);
        }
        callback(null,results);
    })
}


/** Gets all in stock products sorting by price and accepts a boolean parameter that tells if the filtering 
 * should be done descending or ascending  */
function getShopProductsByPriceInOrganization(id, desc, callback) {
    var query =  "SELECT DISTINCT organization.org_id, organization.org_name, prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name, prod_serv.price, " +
    " prod_serv.description, prod_img.img_src FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " +
    " LEFT JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " + 
    " LEFT JOIN organization ON prod_org_sched.org_id = organization.org_id " + 
    " WHERE prod_serv.status = 'In Stock' and organization.org_id = ? ORDER BY prod_serv.price ";
     
    if (desc) query =  query + "DESC"; 

    conn.query(query, id, (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Gets all in stock products, filtering based on category provided as parameter. 
 *      Possible Parameters: ITEM, SERVICE, FOOD */
function getShopProductsByCategoryInOrganization(id, category, callback) {
    var query =  "SELECT DISTINCT organization.org_name, prod_serv.prod_id, prod_serv.category, prod_serv.prod_serv_name, prod_serv.price, " +
    " prod_serv.description, prod_img.img_src FROM prod_serv JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id " +
    " LEFT JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id " + 
    " LEFT JOIN organization ON prod_org_sched.org_id = organization.org_id " + 
    " WHERE prod_serv.status = 'In Stock' and prod_serv.category= ? and organization.org_id = ? ";

    conn.query(query, [category, id], (err, results) => {
        if (err) {
            console.log(err);
            return callback(err,null);
        }
        callback(null,results);
    });
}

/** Search products through org, name, and category
 */
function getSearchedProductByName(searchTerm, callback) {
    const query = `
        SELECT 
            organization.org_name AS organization, 
            prod_serv.prod_id, 
            prod_serv.category, 
            prod_serv.prod_serv_name AS 'name', 
            prod_serv.price, 
            prod_serv.description, 
            prod_img.img_src AS 'image' 
        FROM prod_serv
        JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id
        LEFT JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id
        LEFT JOIN organization ON prod_org_sched.org_id = organization.org_id
        WHERE prod_serv.status = 'In Stock' 
        AND (
            prod_serv.prod_serv_name LIKE ? 
            OR prod_serv.category LIKE ? 
            OR organization.org_name LIKE ?
        )
    `;

    // Add wildcards to the search term for partial matching
    const searchKeyword = `%${searchTerm}%`;

    conn.query(query, [searchKeyword, searchKeyword, searchKeyword], (err, results) => {
        if (err) {
            console.error("Error executing search query:", err);
            return callback(err, null); // Return error to callback
        }
        callback(null, results); // Return results to callback
    });
}


/** End of Shop */


/**
 * Author: Jasmin, Ramon Emmiel P.
 * Description: Returns the reservations of a certain user
 * @param {*} username 
 * @param {*} callback 
 */

function getReservations(username, callback){
    const query = "SELECT " + 
              "ps.prod_id, " +
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
              "WHERE c.username = ?" + 
              "ORDER BY r.date DESC;";
 

    conn.query(query, [username], (err, results) => {
        if(err){
            console.log(err);
            return callback(err, null);
        }else{
            return callback(null, results)
        }
    })
}

/**
 * Author: Jasmin, Ramon Emmiel P.
 * Description: Returns all the reservations of a user based on its status
 * @param {*} status 
 * @param {*} username 
 * @param {*} callback 
 */
function getReservationsByStatus(status, username, callback){
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
                  "WHERE r.status = ? AND c.username = ?" + 
                  "ORDER BY r.date DESC;";

    conn.query(query, [status, username], (err, results) => {
        if(err){
            console.log(err);
            return callback(err, null);
        }else{
            return callback(null, results);
        }
    })
}

function getCustomerID(username) {
    const query = "SELECT " + 
                  "customer_id " + 
                  "FROM customer" +
                  "WHERE username = ?";

    conn.query(query, [username], (err, results) => {
        if(err){
            console.log(err);
            return callback(err, null);
        }else{
            return callback(null, results);
        }
    })
}

function addReservation(prod_id, date, qty, customer_id) {
    const query = "INSERT INTO reservation (customer_id, prod_id, qty, date, status)" +
                    "VALUES (?, ?, ?, ?, 'Pending')"

    conn.query(query, [customer_id, prod_id, qty, date], (err, results) => {
        if(err) {
            console.log(err);
            return callback(err, null);
        } else {
            return callback(null, results);
        }
    })
}

function getBestSelling() {

}

module.exports = {
    getFirstName,
    getLastName,
    getBooths,
    getShopProducts, 
    getOrgProducts, 
    getShopProductsByPrice, 
    getShopProductsByCategory, 
    getProductByID, 
    getSchedulesByProductID, 
    getReservations, 
    getBoothData,
    getReservationsByStatus,
    getSearchedProductByName,
    getShopProductsByPriceInOrganization,
    getShopProductsByCategoryInOrganization,
    getFiveShopProducts,
    addReservation,
    getCustomerID,
    getBestSelling,
}