const model = require('../CustomerQueries');
const sample = [
    {title : 'item1', description : 'lorem ipsum'},
    {title : 'item2', description : 'lorem ipsum'},
]


const booths = new Promise( (resolve, reject) => {
    customerQueries.getBooths((err,results)=> {
        if (err) reject (err);
        else resolve(results);
    });
});

const products = new Promise( (resolve, reject) => {
    customerQueries.getShopProducts((err,results)=> {
        if (err) reject (err);
        else resolve(results);
    });
});

module.exports = {
    booths,
}
