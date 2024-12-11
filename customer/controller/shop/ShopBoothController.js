/** 
Shop Booth Controller

This module defines the logic for handling requests related to a specific shop booth. 
It includes functions to display booth data, sort products by various criteria, and 
filter products by category. The controller interacts with the underlying ShopBooth 
model to fetch, sort, and manipulate product data before rendering the view.

Dependencies
    model: The ShopBooth model is imported, which is responsible for fetching booth data 
    and product information from the data source.

Module Export
    This module exports an object containing several functions: index, sortByPrice, 
    sortByCategory, and allProducts.
*/
const model = require("../../model/shop/ShopBooth");


var orgProducts = [];

function index(id, req, res) {
    const boothData = model.getBoothData(id);

    const breadcrumbs = [
        { label: "Shop", link: "/shop" },
        { label: "Booth", link: `/shop/booth/${id}` }, 
    ];

    if (orgProducts.length ==0) {
        orgProducts = model.getOrgProducts(id);
    }

    Promise.all([boothData, orgProducts]).then (values => {
        res.render("shop/shop_booth_view", {
            title: "Shop Booth",
    
            // Dynamic Objects
            boothData : values[0],
            orgProducts : values[1],
            id : id,
            breadcrumbs
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