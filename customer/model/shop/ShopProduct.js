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

function addProductToCart(session, org_id, product) {
    let cart = session.cart || []
    let org = cart.find(org => org.org_id === org_id);

    // adds a new org if it doesn't exist, since the product will be mapped to an org
    if (!org) {
        org = { org_id, products: [] }; 
        cart.push(org);
    }

    let existingProduct = org.products.find(p => p.product_id === product.product_id);

    if (existingProduct) {
        existingProduct.quantity += product.product_qty;
    } else {
        org.products.push(product);
    }

    session.cart = cart;
}

module.exports = {
    getProductByID,
    getSchedulesByProductID,
    addProductToCart
}