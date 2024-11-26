const model = require('../../model/shop/Shop');

var products;

function index(req, res) {
    const searchTerm = req.query.value;

    // if a search term is provided, fetch searched products; otherwise, fetch all products
    const productsPromise = searchTerm 
        ? model.getSearchedProductByName(searchTerm) 
        : model.getProducts();

    // always fetch booths
    const boothsPromise = model.getBooths();

    // resolve promises and render the view
    Promise.all([boothsPromise, productsPromise])
        .then(values => {
            res.render('shop/shop_view', {
                title: searchTerm ? `Search Results for "${searchTerm}"` : "Shop",
                booths: values[0],
                products: values[1],
            });
        })
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