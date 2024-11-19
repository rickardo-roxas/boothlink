const model = require("../../../model/customer/shop/ShopBooth");



function index(id, req, res) {
    const boothData = model.getBoothData;
    const orgProducts = model.getOrgProducts;
    
    res.render("shop/shop_booth_view", {
        // Dynamic Objects
    });
}

module.exports = {
    index
}