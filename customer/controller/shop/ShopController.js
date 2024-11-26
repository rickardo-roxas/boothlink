const model = require('../../model/shop/Shop');

var products;

function index  (req, res) {
    if (!products) {
        products = model.getProducts();
    }
    let boothsPromise = model.getBooths();
    Promise.all([boothsPromise, products]).then (values => {
        res.render('shop/shop_view',
            {
                title: "Shop",
                booths: values[0],
                products : values[1],
            });
    });
}

function sortByPrice(desc, req, res) {
    products = model.getShopProductsByPrice(desc);
    this.index(req,res);
}

function sortByCategory(category, req, res) {
    products = model.getShopProductsByCategory(category);
    this.index(req,res);
}

module.exports = {
    index,
    sortByPrice,
    sortByCategory
}