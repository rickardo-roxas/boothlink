const model = require('../../model/cart/Cart');

const index = (req, res) => {
    if (!req.session.cart) {
        req.session.cart = [];
    }

    let cartProductsPromise = model.getCart(req.session);

    cartProductsPromise.then(cartProducts => {
        console.log("Cart products:", JSON.stringify(cartProducts, null, 2)); 

        let orgProducts = {} // object to hold products mapped to their organization

        let productDetailsPromise = cartProducts.map(product => {
            console.log("Processing product with prod_id:", product.id); 

            return getProdDetails(product.id).then(productDetails => {
                let orgName = productDetails.org_name;
        
                if (!orgProducts[orgName]) {
                    orgProducts[orgName] = [];
                }
        
                let productWithDetails = {
                    id: product.id,
                    name: productDetails.prod_serv_name,
                    image: productDetails.img_src,
                    price: productDetails.price,
                    schedules: [], 
                    selectedSchedule: product.prod_sched, 
                };
        
                return getSchedules(product.id)
                    .then(schedules => {
                        productWithDetails.schedules = schedules || []; 
                        orgProducts[orgName].push(productWithDetails);
                    });
            });
        });
        

        Promise.all(productDetailsPromise).then(() => {
            const breadcrumbs = [
                {label: "Cart", link: "/cart"},
            ];

            res.render("cart/cart_view", {
                title: "Cart",
                breadcrumbs,
                orgProducts
            })
        })
    })
}


function getProdDetails(id) {
    return model.getProductInfo(id)
}

function getSchedules(id) {
    return model.getSchedules(id)
}

module.exports = {
    index,
    getProdDetails,
    getSchedules
}