const customerQueries = require('../CustomerQueries');

function getProductByID(id) {
    return new Promise((resolve, reject) => {
        customerQueries.getProductByID(id, (err, results) => {
            if (err) reject (err);
            else resolve (results);
        });
    });
}


function getSchedulesByProductID(id) {
    if (id === null) return [];
    return new Promise((resolve, reject) => {
        customerQueries.getSchedulesByProductID(id, (err,results) => {
            if (err) reject (err);
            else resolve(results);
        });
    });
}


module.exports = {
    getProductByID,
    getSchedulesByProductID
}