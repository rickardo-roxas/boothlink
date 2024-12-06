const model = require('../../model/cart/Cart');

const index = (req, res) => {
    if (!req.session.cart) {
        req.session.cart = [];
    }

    let cartProductsPromise = model.getCart(req.session);

    cartProductsPromise.then(cartProducts => {
        let orgProducts = {} // object to hold products mapped to their organization

        let productDetailsPromise = cartProducts.map(product => {
            return getProdDetails(product.prod_id).then(productDetails => {
                let orgName = productDetails.org_name

                if (!orgProducts[orgName]) {
                    orgProducts[orgName] = [];
                }

                let productWithDetails = {
                    id: product.prod_id,
                    name: productDetails.prod_serv_name,
                    image: productDetails.img_src,
                    price: productDetails.price,
                    schedules: []
                }

                return getSchedules(product.prod_id).then(schedules => {
                    productWithDetails.schedules = schedules;
                    orgProducts[orgName].push(productWithDetails);
                })
            })
        })

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


function getProdDetails(prod_id) {
    return model.getProductInfo(prod_id)
}

function getSchedules(prod_id) {
    return model.getSchedules(prod_id)
}

module.exports = {
    index,
}