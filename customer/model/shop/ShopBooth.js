const customerQueries = require('../CustomerQueries');

function getBoothData(id) {
    return new Promise((resolve, reject) => {
        customerQueries.getBoothData(id, (err, results) => {
            if (err) reject (err);
            else resolve (results);
        });
    });
}

function getOrgProducts(id) {
    return new Promise( (resolve, reject) => {
        customerQueries.getOrgProducts(id, (err, results) => {
            if (err) reject (err);
            else resolve(results);
        });
    });
}

function sortByPrice(id, desc) {
    if (id === null) return [];
    return new Promise((resolve, reject) => {
        customerQueries.getShopProductsByPriceInOrganization(id, desc, (err,results) => {
            if (err) reject (err);
            else resolve(results);
        });
    });
}

function sortByCategory(id, category) {
    console.log("ID: " + id + " === CATEGORY: " + category);
    if (id === null) return [];
    return new Promise((resolve, reject) => {
        customerQueries.getShopProductsByCategoryInOrganization(id, category, (err,results) => {
            if (err) reject (err);
            else resolve(results);
        });
    });
}


module.exports = {
    getBoothData,
    getOrgProducts,
    sortByPrice,
    sortByCategory
}