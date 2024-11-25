const express = require('express');

var controller;

const router = express.Router();

router.get('/', (req, res) => {
    controller = require ('../shop/ShopController');
    controller.index(req,res);
});

router.get('/filter', (req, res) => {
    const {title, price, category} = req.query;
    switch (title) {
        case "price":
            controller.sortByPrice(price)
            break;
        case "category":
            controller.sortByCategory(category)
            break;
        default:
            // Error Case
            res.redirect("/shop");
            break;
    }
    controller.index(req,res);
});

router.get('/booth', (req,res)=> {
    controller = require('../shop/ShopBoothController');
    const boothParameter = req.query.id;
    controller.index(boothParameter, req, res);
});

router.get('/reserve', (req,res) => {
    ctrler = require('../shop/ShopProductController'); //Makes use of a different name to not interfere with filter functionality
    const productID = req.query.id;
    ctrler.index(productID, req,res);
});


router.post('/', (req,res) => {
    if (req.body.action == "Add to Cart") {
        const item = [req.body.productID, req.body.quantity];
        req.session.cart.push(item);
    }
});

module.exports = router;