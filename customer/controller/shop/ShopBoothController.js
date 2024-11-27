const model = require("../../model/shop/ShopBooth");


var orgProducts = [];

function index(id, req, res) {
    const boothData = model.getBoothData(id);

    if (orgProducts.length ==0) {
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

function allProducts(id, req, res) {
    orgProducts = model.getOrgProducts(id);
    this.index(id, req,res);
}
function sortByPrice(id, desc, req, res) {
    orgProducts = model.sortByPrice(id, desc);
    this.index(id, req,res);
}

function sortByCategory(id, category, req, res) {
    orgProducts = model.sortByCategory(id, category);
    this.index(id, req, res);
}

module.exports = {
    index,
    sortByPrice,
    sortByCategory, 
    allProducts
}