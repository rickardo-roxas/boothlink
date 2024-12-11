/*
Shop Booth Module

This module interacts with the database to retrieve and filter data related to a specific 
booth and its products. It provides functions to fetch booth details, products associated
with a booth, and products filtered by price or category. Each of these functions returns a 
Promise, making it easier to handle asynchronous operations and errors.

Dependencies
    customerQueries: This module depends on customerQueries, which contains the actual SQL 
    queries for retrieving booth data, products, and filtered product lists (by price or 
    category). These queries are executed via callbacks and are wrapped in Promises for 
    asynchronous handling.

Module Export
    This module exports functions for retrieving booth data, organizational products, and 
    filtering products by price and category.
*/
const customerQueries = require('../CustomerQueries');

function getBoothData(id) {
    return new Promise((resolve, reject) => {
        customerQueries.getBoothData(id, (err, results) => {
            if (err) reject (err);
            else resolve (results[0]);
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