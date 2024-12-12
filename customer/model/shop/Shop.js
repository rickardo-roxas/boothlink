/*
Shop Module

This module is responsible for interacting with the database and executing various 
queries related to booths and products in the shop. The queries are abstracted using 
Promises, making them asynchronous and enabling cleaner error handling with resolve 
and reject.

Dependencies
    customerQueries: This module relies on the customerQueries object, which contains 
    the actual database queries for booths, products, and searching. It uses callback-based 
    functions to execute queries, which are then wrapped in Promises for better asynchronous 
    handling.

Module Export
    This module exports several functions, each corresponding to a specific query operation 
    related to booths and products.
*/
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

function getBestSellingShop() {
    return new Promise((resolve, reject) => {
        customerQueries.getBestSellingShop((err,results) => {
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

function getSearchedProductByName(searchTerm) {
    return new Promise((resolve, reject) => {
        customerQueries.getSearchedProductByName(searchTerm, (err, results) => {
            if (err) reject(err);
            else resolve(results);
        });
    });
}


module.exports = {
    getBooths,
    getProducts,
    getShopProductsByPrice,
    getShopProductsByCategory,
    getSearchedProductByName,
    getBestSellingShop,
}
