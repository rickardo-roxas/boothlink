const model = require('../../model/cart/Checkout');

const index = (req, res) => {
    const breadcrumbs = [
        { label: "Cart", link: "/cart" },
        { label: "Checkout", link: "/cart/checkout" },
    ];

    let checkoutProductsPromise = model.getCheckout(req.session);

    checkoutProductsPromise.then(checkoutProducts => {
        console.log("Cart products:", JSON.stringify(checkoutProducts, null, 2)); 

        let orgProducts = {}; 

        let productDetailsPromise = checkoutProducts.map(product => {
            const prod_id = parseInt(product.prod_id); 
            console.log("Processing product with prod_id:", prod_id); 

            return getProdDetails(prod_id).then(productDetails => {
                let orgName = productDetails.org_name;

                if (!orgProducts[orgName]) {
                    orgProducts[orgName] = [];
                }

                let productWithDetails = {
                    id: prod_id, 
                    quantity: product.quantity,
                    name: productDetails.prod_serv_name,
                    image: productDetails.img_src,
                    price: productDetails.price,
                    schedules: [], 
                    selectedSchedule: product.schedule, 
                };

                return getSchedules(prod_id)
                    .then(schedules => {
                        productWithDetails.schedules = schedules || []; 
                        orgProducts[orgName].push(productWithDetails);
                    });
            });
        });

        Promise.all(productDetailsPromise).then(() => {
            const breadcrumbs = [
                {label: "Cart", link: "/cart"},
                {label: "Checkout", link: "/checkout"},
            ];

            res.render("cart/checkout_view", {
                title: "Checkout",
                breadcrumbs,
                orgProducts,
                formatDateTime,
            })
        })
    })
}

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

module.exports = {
    index,
    getProdDetails,
};
