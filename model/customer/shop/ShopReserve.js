const customerQueries = require('../CustomerQueries');

function getProductByID(productID) {
    return new Promise((resolve, reject) =>{
        customerQueries.getProductByID(productID, (err, results) => {
            if (err) reject(err);
            else resolve(results);
        });
    });
}

function getScheduleByScheduleID(schedID) {
    return new Promise((resolve, reject) => {
        customerQueries.getScheduleByScheduleID(schedID, (err, results) => {
            if (err) reject(err);
            else resolve(results);
        });
    });
}

module.exports = {
    getProductByID,
    getScheduleByScheduleID
}