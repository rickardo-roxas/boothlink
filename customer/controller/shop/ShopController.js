const model = require('../../model/shop/Shop');

var products;

const index = (req, res) => {
    if (!products) {
        products = model.getProducts;
    }
    let boothsPromise = model.getBooths();
    Promise.all([boothsPromise]).then (values => {
        res.render('shop/shop_view',
            {
                title: "Shop",
                //  products : products,
                booths: values[0],
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