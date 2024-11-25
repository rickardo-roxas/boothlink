const customerQueries = require('../CustomerQueries');

function getProductByID(id) {
    return new Promise((resolve, reject) => {
        customerQueries.getProductByID(id, (err, results) => {
            if (err) reject (err);
            else resolve (results);
        });
    });
}

module.exports = {
    getProductByID
}