const model = require('../../model/cart/Checkout');

const index = (req, res) => {
    const breadcrumbs = [
        { label: "Cart", link: "/cart" },
        { label: "Checkout", link: "/cart/checkout" },
    ];

    let checkoutProductsPromise = model.getCheckout(req.session);

    checkoutProductsPromise.then(checkoutProducts => {
        console.log("Cart products:", JSON.stringify(checkoutProducts, null, 2)); 

        // Process products without organization and schedule info
        let products = checkoutProducts.map(product => {
            const prod_id = parseInt(product.prod_id); // Ensuring correct product ID is parsed
            console.log("Processing product with prod_id:", prod_id);

            return getProdDetails(prod_id).then(productDetails => {
                return {
                    id: prod_id,
                    quantity: product.quantity, // Include the quantity of the product
                    name: productDetails.prod_serv_name,
                    image: productDetails.img_src,
                    price: productDetails.price,
                };
            });
        });

        Promise.all(products).then(productDetails => {
            res.render("cart/checkout_view", {
                title: "Checkout",
                breadcrumbs,
                products: productDetails, // Send products array to view
                formatDateTime,
            });
        });
    })
    .catch(error => {
        console.error("Error fetching checkout products:", error);
        res.redirect('/cart'); // Redirect to cart in case of an error
    });
};



function getProdDetails(id) {
    return model.getProductInfo(id)
}

function formatDateTime(dateStr, timeStr) {
    const date = new Date(dateStr);
    const hours = parseInt(timeStr.split(':')[0]);
    const minutes = timeStr.split(':')[1];
    
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 || 12;  
    const formattedTime = `${formattedHours}:${minutes} ${ampm}`;
    
    const month = date.toLocaleString('default', { month: 'short' });
    const day = date.getDate();
    const year = date.getFullYear();

    return `${month} ${day}, ${year} - ${formattedTime}`;
}

function createReservation(username, prod_id, sched_id, qty) {
    return new Promise((resolve, reject) => {
        console.log("Creating reservation for:", { username, prod_id, sched_id, qty });

        model.getCustomerID(username)
            .then(customerResults => {
                if (customerResults.length === 0) {
                    reject(new Error('Customer not found.'));
                    return;
                }

                const customer_id = customerResults[0].customer_id;
                console.log("Customer ID retrieved:", customer_id);

                return model.getScheduleDate(sched_id).then(scheduleResults => ({
                    customer_id,
                    scheduleResults,
                }));
            })
            .then(({ customer_id, scheduleResults }) => {
                if (!scheduleResults || scheduleResults.length === 0) {
                    reject(new Error('Schedule not found.'));
                    return;
                }

                const scheduleDate = scheduleResults[0].date;
                const formattedDate = new Date(scheduleDate).toISOString().split('T')[0]; // Convert to "YYYY-MM-DD"
                console.log("Formatted Schedule Date:", formattedDate);

                // Create the reservation
                return model.createReservation(customer_id, prod_id, formattedDate, qty);
            })
            .then(reservationResult => {
                console.log("Reservation created successfully:", reservationResult);
                resolve(reservationResult);
            })
            .catch(error => {
                console.error("Error in createReservationForController:", error);
                reject(error);
            });
    });
}


module.exports = {
    index,
    getProdDetails,
    createReservation,
};
