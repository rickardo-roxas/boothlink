const model = require("../../model/shop/ShopBooth");


var orgProducts;

function index(id, req, res) {
    const boothData = model.getBoothData(id);

    if (!orgProducts) {
        orgProducts = model.getOrgProducts(id);
    }

    Promise.all([boothData, orgProducts]).then (values => {
        res.render("shop/shop_booth_view", {
            title: "Shop Booth",
    
            // Dynamic Objects
            boothData : values[0],
            orgProducts : values[1],
            id : id
        });

    });
}
function sortByPrice(id, desc, req, res) {
    products = model.getShopProductsByPriceInOrganization(id, desc);
    this.index(id, req,res);
}

function sortByCategory(id, category, req, res) {
    products = model.getShopProductsByCategoryInOrganization(id, category);
    this.index(id, req, res);
}

module.exports = {
    index,
    sortByPrice,
    sortByCategory
}