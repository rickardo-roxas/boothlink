const customerQueries = require('../CustomerQueries');

function getProductInfo(prod_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getProductByID(prod_id, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

module.exports = {
    getProductInfo,
}