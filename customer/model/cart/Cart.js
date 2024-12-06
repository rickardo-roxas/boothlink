const customerQueries = require('../CustomerQueries');

function getCart(session) {
    return new Promise((resolve, reject) => {
        let cart = session.cart || [];

        if (cart.length === 0) {
            resolve([])
        } else {
            let productDetailsPromises = cart.map(product => {
                return getProductInfo(parseInt(product.prod_id)).then(productDetails => {
                    productDetails.pickupOptions = [];
                    return getSchedules(parseInt(product.prod_id)).then(schedules => {
                        productDetails.schedules = schedules;
                        productDetails.pickupOptions = schedules.map(schedule => {
                            return `${schedule.date} - ${schedule.start_time}`;
                        });
                        return productDetails;
                    });
                });
            });

            Promise.all(productDetailsPromises).then((resolvedProducts, error) => {
                error ? reject(error) : resolve(resolvedProducts);
            })
        }
    })
}

function getSchedules(prod_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getSchedulesByProductID(parseInt(prod_id), (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

function getProductInfo(prod_id) {
    return new Promise((resolve, reject) => {
        customerQueries.getProductByID(parseInt(prod_id), (error, results) => {
            error ? reject(error) : resolve(results)
        })
    })
}

module.exports = {
    getCart,
    getSchedules,
    getProductInfo,
}