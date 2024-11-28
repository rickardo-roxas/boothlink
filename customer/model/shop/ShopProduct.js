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

function addOrgToCart(session, org_id) {
    const cart = session.cart
    if (!cart.includes(org_id)) {
        session.cart.push({org_id, products:[]})
    }
}

function addProductToCart(session, org_id, product) {
    const org = session.cart.find(org => org.org_id === org_id);
    if (org) {
        const currProduct = org.products.find(prod => prod.product_id === product.product_id)
        if (currProduct) {
            currProduct.quantity += product.product_qty
        } else {
            org.products.push(product)
        }
    } else {
        session.cart.push({
            org_id,
            products: [prod_id]
        })
    }
}


module.exports = {
    getProductByID,
    getSchedulesByProductID
}