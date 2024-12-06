const express = require('express');

var controller;

const router = express.Router();

router.get('/', (req, res) => {
    if (!req.session.cart) {
        req.session.cart = []
    }

    const filter_type = req.query.category;
    
    if (filter_type) {
        switch (filter_type) {
            case "low-to-high":
                controller.sortByPrice(false, req, res);
                break;
            case "high-to-low":
                controller.sortByPrice(true, req, res);
                break;
            case "best-selling":
                //TODO;
                break;
            case "item":
                controller.sortByCategory("item", req, res);
                break;
            case "service":
                controller.sortByCategory("sevice", req, res);
                break;
            case "food":
                controller.sortByCategory("food", req, res);
                break;

            default:
                // Error Case
                res.redirect("/shop");
                break;
        }
        controller.index(req,res);
    } else {
        controller = require ('../shop/ShopController');
        controller.allProducts(req,res);
    }
});



router.get('/booth', (req,res)=> {
    controller = require ( '../shop/ShopBoothController');
    const boothParameter = req.query.id;
    const filter_type = req.query.category;
    
    if (filter_type) {
        switch (filter_type) {
            case "low-to-high":
                controller.sortByPrice(boothParameter, false, req, res);
                break;
            case "high-to-low":
                controller.sortByPrice(boothParameter, true, req, res);
                break;
            case "best-selling":
                //TODO;
                break;
            case "item":
                controller.sortByCategory(boothParameter, "item", req, res);
                break;
            case "service":
                controller.sortByCategory(boothParameter, "service", req, res);
                break;
            case "food":
                controller.sortByCategory(boothParameter, "food", req, res);
                break;

            default:
                // Error Case
             //   res.redirect("/shop");
                break;
        }
    } else {
        controller = require('../shop/ShopBoothController');
        controller.allProducts(boothParameter, req, res);
    }
});

router.get('/reserve', (req,res) => {
    ctrler = require('../shop/ShopProductController'); //Makes use of a different name to not interfere with filter functionality
    const productID = req.query.id;
    ctrler.index(productID, req,res);
});

router.get('/add-to-cart', (req,res) => {
    //ctrler = require('../shop/ShopProductController');
    console.log(req);
    let org_id = req.query.org_id;
    let prod_id = req.query.prod_id;
    let prod_qty = req.query.prod_qty;
    let prod_sched = req.query.radio1;

    console.log("TEST: " + org_id + prod_id + prod_qty);

    ctrler.addProductToCart(org_id, prod_id, prod_qty, prod_sched, req, res);
    //res.redirect('/')
});

module.exports = router;