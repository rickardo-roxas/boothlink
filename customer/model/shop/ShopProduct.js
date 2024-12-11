/**
Shop Product Module

This module handles queries related to products, including retrieving product details, 
schedules for a product, and adding products to the shopping cart. The module interacts 
with the customerQueries module, which contains the actual SQL queries for these operations, 
and returns results wrapped in Promises for asynchronous handling.

Dependencies
    customerQueries: The module relies on customerQueries for executing SQL queries related 
    to products, schedules, and cart operations. These queries are callback-based and are 
    wrapped in Promises for asynchronous handling.

    Module Export
    The module exports three functions:
        getProductByID
        getSchedulesByProductID
        addProductToCart

Each function is designed to interact with product-related data and provide the results or 
update the session as needed.
 */
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