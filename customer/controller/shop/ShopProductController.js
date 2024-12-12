/**
Shop Product Controller

This module defines the logic for handling requests related to individual products in the 
shop, including displaying product details, schedules, and adding products to the cart. 
It interacts with the ShopProduct model to retrieve product and schedule data, as well as 
handle cart functionality.

Dependencies
    model: The ShopProduct model is imported, which contains methods for retrieving product 
    details, schedules, and managing the shopping cart.

Module Export
    This module exports an object containing two functions: index and addProductToCart. 
*/
const model = require("../../model/shop/ShopProduct");

function index(id, req, res) {
    let productPromise = model.getProductByID(id);
    let schedulesPromise = model.getSchedulesByProductID(id);

    Promise.all([productPromise, schedulesPromise]).then(results => {
        const breadcrumbs = [
            { label: "Shop", link: "/shop" },
            { label: "Reserve", link: `/shop/reserve/${id}` }, 
        ];

        res.render("shop/shop_product_view", {
            title: "Shop Product",
    
            // Dynamic Objects
            product : results[0],
            schedules : results[1],
            breadcrumbs,
            prod_id: id
        });
    });
}

function addProductToCart(org_id, prod_id, prod_qty, prod_sched, req, res) {

    const product = {
        product_id: parseInt(prod_id),
        product_qty: parseInt(prod_qty),
        product_sched : parseInt(prod_sched)
    };

    console.log("SHOP PROD CONTROLLER:" + product.product_sched);

    if (!req.session.cart) {
        req.session.cart = [];
    }

    let org = req.session.cart.find(org => org.org_id === org_id);

    if (!org) {
        org = {
            org_id: org_id,
            products: [],
        };
        req.session.cart.push(org);
    }

    let cartProduct = org.products.find(prod => prod.product_id === product.product_id);

    if (cartProduct) {
        cartProduct.product_qty += product.product_qty;
        console.log("THE SCHEDULE: " + product.product_sched)
        cartProduct.product_sched = product.product_sched; 
    } else {
        // Add new product to the organization's products list
        org.products.push(product);
    }

    console.log("Updated Session Cart:", JSON.stringify(req.session.cart, null, 2));
    res.redirect('/cart'); // To change to an alert message
}

module.exports = {
    index,
    addProductToCart,
}