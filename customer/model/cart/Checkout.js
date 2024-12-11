const customerQueries = require('../CustomerQueries');

function getCheckout(session) {
    return new Promise((resolve, reject) => {
        const checkout = session.checkout || [];
        console.log("Session Checkout Data:", JSON.stringify(checkout, null, 2));

        // Filter to ensure only valid objects are processed
        const products = checkout
            .filter(item => typeof item === 'object' && item.prod_id && item.qty && item.sched_id && item.org_id)
            .map(item => ({
                prod_id: item.prod_id,
                qty: item.qty,
                sched_id: item.sched_id,
                org_id: item.org_id,
            }));

        if (products.length === 0) {
            console.error("Invalid session data: No valid products found");
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
                org_id: product.org_id,
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

function createReservation(username, prod_id, date, qty) {
    return new Promise((resolve, reject) => {
        getCustomerID(username)
            .then(result => {
                if (result.length === 0) {
                    reject(new Error('Customer not found.'));
                    return;
                }
                const customer_id = result[0].customer_id;

                return createReservation(prod_id, date, qty, customer_id);
            })
            .then(reservationResult => {
                resolve(reservationResult);  
            })
            .catch(err => {
                reject(err); 
            });
    });
}


module.exports = {
    getProductInfo,
    getCheckout,
    createReservation
};
