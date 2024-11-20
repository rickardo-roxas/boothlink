const model = require('../../model/shop/Shop');

var products;

const index = (req, res) => {
    if (!products) {
        products = model.getProducts;
    }

    res.render('shop/shop_view', 
        { 
            title : "Shop", 
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