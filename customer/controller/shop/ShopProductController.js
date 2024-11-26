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


module.exports = {
    index,
}