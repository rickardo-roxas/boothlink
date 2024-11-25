const model = require("../../model/shop/ShopProduct");



function index(id, req, res) {
    const boothData = model.getBoothData(id);
    const orgProducts = model.getOrgProducts(id);

    Promise.all([boothData, orgProducts]).then (values => {
        res.render("shop/shop_product_view", {
            title: "Shop Booth",
    
            // Dynamic Objects
            boothData : values[0],
            orgProducts : values[1],
            id : id
        });

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