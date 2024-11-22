const { getReservations : getReservationsQuery } = require('../CustomerQueries');

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

function processReservations(results){

    if (!Array.isArray(results)) {
        console.error("Expected an array of results, but got:", results);
        return [];  // Return an empty array if the data isn't in the expected format
    }

    return results.map(reservation => ({
        img_src: reservation.image_source,     
        org_name: reservation.org_name,        
        item_name: reservation.item_name,      
        category: reservation.category,        
        price: reservation.price,              
        date: reservation.date,                
        status: reservation.status,            
        qty: reservation.qty,                  
        grand_total: reservation.total_price   
    }));
}

module.exports = {
    getReservations
}