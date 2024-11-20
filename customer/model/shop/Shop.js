const customerQueries = require('../CustomerQueries');

function getBooths() { 
    return new Promise( (resolve, reject) => {
        customerQueries.getBooths((err,results)=> {
            if (err) reject (err);
            else resolve(results);
        });
    });
}

function getProducts() { 
    return new Promise( (resolve, reject) => {
        customerQueries.getShopProducts((err,results)=> {
            if (err) reject (err);
            else resolve(results);
        });
    });
}

function getShopProductsByPrice(desc) {
    return new Promise((resolve, reject) => {
        customerQueries.getShopProductsByPrice(desc, (err,results) => {
            if (err) reject (err);
            else resolve(results);
        });
    });
}

function getShopProductsByCategory(category) {
    return new Promise((resolve, reject) => {
        customerQueries.getShopProductsByCategory(category, (err,results) => {
            if (err) reject (err);
            else resolve(results);
        });
    });
}




module.exports = {
    getBooths,
    getProducts,
    getShopProductsByPrice,
    getShopProductsByCategory
}
