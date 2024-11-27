const express = require('express');

var controller;

const router = express.Router();

router.get('/', (req, res) => {
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
        controller.index(req,res);
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
                controller.sortByCategory(boothParameter, "sevice", req, res);
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
        controller.index(boothParameter, req, res);
    }
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