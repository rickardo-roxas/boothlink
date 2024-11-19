const customerQueries = require("../CustomerQueries");

function getBoothData(id) {
    return new Promise((resolve, reject) => {
        customerQueries.getBoothData(id, (err, results) => {
            if (err) reject(err);
            else resolve (results);
        });
    })
}

function getOrgProducts(id) {
    return new Promise((resolve, reject) => {
        customerQueries.getOrgProducts(id, (err, results) => {
            if (err) reject(err);
            else resolve(results);
        })
    })
}

function getShopProductsByCategoryInOrganization(id, category) {
    return new Promise((resolve, reject) => {
        customerQueries.getShopProductsByCategoryInOrganization(id, category, (err,results) => {
            if (err) reject(err);
            else resolve(results)
        });
    });

}

function getShopProductsByPriceInOrganization(id, category) {
    return new Promise((resolve, reject) => {
        customerQueries.getShopProductsByPriceInOrganization(id, category, (err, results) => {
            if (err) reject(err);
            else resolve(results);
        })
    });
}


module.exports = {
    getBoothData,
    getOrgProducts,
    getShopProductsByCategoryInOrganization,
    getShopProductsByPriceInOrganization
}