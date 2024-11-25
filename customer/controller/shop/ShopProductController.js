const model = require("../../model/shop/ShopProduct");



function index(id, req, res) {
    let productPromise = model.getProductByID(id);

    Promise.all([productPromise]).then (values => {
        res.render("shop/shop_product_view", {
            title: "Shop Product",
    
            // Dynamic Objects
            product : values[0],
        });

    });
}


module.exports = {
    index,
}