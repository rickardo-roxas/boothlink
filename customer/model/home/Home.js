const customerQueries = require('../CustomerQueries');

const sample = [
    {title : 'item1', description : 'lorem ipsum'},
    {title : 'item2', description : 'lorem ipsum'},
]

function getFiveProducts() { 
    return new Promise( (resolve, reject) => {
        customerQueries.getFiveShopProducts((err,results)=> {
            if (err) reject (err);
            else resolve(results);
        });
    });
}

function getBooths() { 
    return new Promise( (resolve, reject) => {
        customerQueries.getBooths((err,results)=> {
            if (err) reject (err);
            else resolve(results);
        });
    });
}


module.exports = {
    sample,
    getFiveProducts,
    getBooths
}