const customerQueries = require('../CustomerQueries');

function getCart(session) {
    return new Promise((resolve, reject) => {
        const cart = session.cart || [];

        const products = cart.flatMap(org =>
            org.products.map(product => ({
                ...product,
                org_id: org.org_id 
            }))
        );

        if (products.length === 0) {
            resolve([]);
        }

        const productDetailsPromises = products.map(product => {
            const prod_id = product.product_id;
            if (isNaN(prod_id)) {
                console.error("Invalid product_id:", product.product_id);
                return Promise.reject(new Error("Invalid product ID"));
            }

            return getProductInfo(prod_id).then(productDetails => {
                productDetails.pickupOptions = [];
                return getSchedules(prod_id).then(schedules => {
                    productDetails.schedules = schedules;
                    productDetails.pickupOptions = schedules.map(schedule => {
                        return `${schedule.date} - ${schedule.start_time}`;
                    });
                    return {
                        ...productDetails,
                        quantity: product.product_qty, 
                        schedule: product.product_sched, 
                        org_id: product.org_id 
                    };
                });
            });
        });

        Promise.all(productDetailsPromises)
            .then(resolvedProducts => resolve(resolvedProducts))
            .catch(reject);
    });
}


function getSchedules(prod_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getSchedulesByProductID(prod_id, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

function getProductInfo(prod_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getProductByID(prod_id, (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

module.exports = {
    getCart,
    getSchedules,
    getProductInfo,
}