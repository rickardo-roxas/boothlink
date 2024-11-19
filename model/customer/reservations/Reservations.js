const { getReservations : getReservationsQuery } = require('model/customer/CustomerQueries.js');

function getReservations(username){
    return new Promise((resolve, reject) => {
        getReservationsQuery(username, (err, results) => {
            if(err){
                return reject(err);
            }

            const processedResults = processReservations(results);
            resolve(processedResults);
        });
    });
}

function processReservations(results){
    return results.map(reservation => ({
        img_src: reservation.image_source,
        org_name: reservation.org_name,
        prod_serv_name: reservation.item_name,
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