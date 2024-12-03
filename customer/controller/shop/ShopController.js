const model = require('../../model/shop/Shop');

var productsPromise;

function index(req, res) {
    const searchTerm = req.query.value;
    const breadcrumbs = [
        { label: "Shop", link: "/shop" },
    ];

    
    if (searchTerm) {
    // if a search term is provided, fetch searched products; otherwise, fetch all products
    productsPromise = searchTerm 
        ? model.getSearchedProductByName(searchTerm) 
        : model.getProducts();
    } 
    
    // always fetch booths
    const boothsPromise = model.getBooths();


    // resolve promises and render the view
    Promise.all([boothsPromise, productsPromise])
        .then(values => {
            res.render('shop/shop_view', {
                title: searchTerm ? `Search Results for "${searchTerm}"` : "Shop",
                booths: values[0],
                products: values[1],
                breadcrumbs
            });
        })
}

function allProducts(req,res) {
    productsPromise = model.getProducts();
    this.index(req,res);
}

function sortByPrice(desc, req, res) {
    productsPromise = model.getShopProductsByPrice(desc);
    this.index(req,res);
}

function sortByCategory(category, req, res) {
    productsPromise = model.getShopProductsByCategory(category);
    this.index(req,res);
}

module.exports = {
    index,
    sortByPrice,
    sortByCategory,
    allProducts
}