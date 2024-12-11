const customerQueries = require('../CustomerQueries');

function getCheckout(session) {
    return new Promise((resolve, reject) => {
        const checkout = session.checkout || [];
        console.log("Session Checkout Data:", JSON.stringify(checkout, null, 2));

        // Filter to ensure only valid objects are processed
        const products = checkout
            .filter(item => typeof item === 'object' && item.product_id && item.product_qty && item.product_sched)
            .map(item => ({
                prod_id: item.product_id,  
                qty: item.product_qty,      
                sched_id: item.product_sched 
            }));

        if (products.length === 0) {
            resolve([]);
            return;
        }

        const productDetailsPromises = products.map(product => {
            const prod_id = parseInt(product.prod_id, 10);
            if (isNaN(prod_id) || prod_id <= 0) {
                console.error("Invalid product_id:", product.prod_id);
                return Promise.reject(new Error("Invalid product ID"));
            }

            return getProductInfo(prod_id).then(productDetails => ({
                ...productDetails,
                prod_id: product.prod_id,
                quantity: product.qty,
                schedule: product.sched_id,
            }));
        });

        Promise.all(productDetailsPromises)
            .then(resolvedProducts => resolve(resolvedProducts))
            .catch(error => {
                console.error("Error resolving product details:", error);
                reject(error);
            });
    });
}

function getProductInfo(prod_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getProductByID(prod_id, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

function getOrgDetails(org_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getBoothData(org_id, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

function getCustomerID(username) {
    return new Promise((resolve, reject) => {
        customerQueries.getCustomerID(username, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

function getScheduleDate(sched_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getSchedule(sched_id, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

function createReservation(customer_id, prod_id, date, qty) {
    return new Promise((resolve, reject) => {
        customerQueries.addReservation(prod_id, date, qty, customer_id, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

module.exports = {
    getProductInfo,
    getCheckout,
    createReservation,
    getCustomerID,
    getScheduleDate,
};
