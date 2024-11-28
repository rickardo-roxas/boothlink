const model = require("../../model/shop/ShopProduct");

function index(id, req, res) {
    let productPromise = model.getProductByID(id);
    let schedulesPromise = model.getSchedulesByProductID(id);

    Promise.all([productPromise, schedulesPromise]).then(results => {
        res.render("shop/shop_product_view", {
            title: "Shop Product",
    
            // Dynamic Objects
            product : results[0],
            schedules : results[1]
        });
    });
}

function addProductToCart(req, res) {
    let org_id = req.query.org_id
    let prod_id = req.query.prod_id
    let prod_qty = req.query.prod_qty; 
    const product = {
        product_id: prod_id,
        product_qty: prod_qty,
        // to add other information
    };
    model.addProductToCart(req.session, org_id, product);

    req.session.alertMessage = 'Product successfully added to the cart!';
    
    // to change redirection to the same page.
    res.redirect('/cart');
}


module.exports = {
    index,
    addProductToCart,
}