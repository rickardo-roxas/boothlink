const model = require("../../../model/customer/shop/ShopBooth");



function index(id, req, res) {
    const boothData = model.getBoothData(id);
    const orgProducts = model.getOrgProducts (id);

    res.render("shop/shop_booth_view", {
        title: "Shop Booth"
        // Dynamic Objects
    });
}

function sortByPrice(desc) {
    products = model.getShopProductsByPrice(desc);
}

function sortByCategory(category) {
    products = model.getShopProductsByCategory(category);
}

module.exports = {
    index,
    sortByPrice,
    sortByCategory
}