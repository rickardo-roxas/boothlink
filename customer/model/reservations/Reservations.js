const { 
    getReservations : getReservationsQuery,
    getReservationsByStatus : getReservationsByStatusQuery
 } = require('../CustomerQueries');

 /**
  * Author: Jasmin, Ramon Emmiel P.
  * Description: An asynchronous function that returns the raw query of all products as a Promise
  * @param {*} username 
  * @returns Promise
  */
function getReservations(username){
    return new Promise((resolve, reject) => {
        getReservationsQuery(username, (err, results) => {
            if(err){
                return reject(err);
            }

            console.log("Raw results from query:", results);
            const processedResults = processReservations(results);
            resolve(processedResults);
        });
    });
}

/**
 * Author: Jasmin, Ramon Emmiel P.
 * Description: Returns the raw result of all products with respect to their status as a Promise
 * @param {*} status 
 * @param {*} username 
 * @returns 
 */
function getReservationsByStatus(status, username){
    return new Promise((resolve, reject) => {
        getReservationsByStatusQuery(status, username, (err, results) => {
            if(err){
                return reject(err);
            }
            
            const processedResults = processReservations(results);
            resolve(processedResults);
        })
    })
}

/**
 * Author: Jasmin, Ramon Emmiel P.
 * Description: This maps the columns of the raw result from the query to their descriptive name
 * @param {*} results 
 * @returns 
 */
function processReservations(results){

    if (!Array.isArray(results)) {
        console.error("Expected an array of results, but got:", results);
        return [];  // Return an empty array if the data isn't in the expected format
    }

    return results.map(reservation => ({
        prod_id: reservation.prod_id,
        image_source: reservation.image_source,     
        org_name: reservation.org_name,        
        item_name: reservation.item_name,      
        category: reservation.category,        
        price: reservation.price,              
        date: reservation.date,                
        status: reservation.status,            
        qty: reservation.qty,                  
        total_price: reservation.total_price   
    }));
}

module.exports = {
    getReservations,
    getReservationsByStatus
}