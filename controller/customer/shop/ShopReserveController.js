const model = require('../../../model/customer/shop/ShopReserve');


function index(id, req, res) {
    const productData = model.getProductByID(id);
    console.log(productData.sched_id);
    const vendorData = model.getScheduleByScheduleID(productData.sched_id);
    res.render('shop/shop_reserve_view', {
        title: "Shop"
    });
}

module.exports = {
    index
}