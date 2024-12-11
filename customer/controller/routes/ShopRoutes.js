/**
Shop Routes (Express Router)

This module defines the routes related to the shop section of an e-commerce application. 
It handles HTTP requests for viewing products, filtering by categories, adding products 
to the cart, and reserving items. The routes also interact with different controllers to 
manage shop-related logic, such as sorting products and handling user interactions.

Dependencies
    express: The web application framework used to create the routes.
    Dynamic Controller Import: The controller is dynamically imported based on the route
    and the action to be performed (e.g., ShopController, ShopBoothController, 
        ShopProductController).
        
Module Export
    This module exports an Express router that is used to handle requests for shop-related 
    actions.
 */
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
    ctrler = require('../shop/ShopProductController');
    let org_id = req.query.org_id;
    let prod_id = req.query.prod_id;
    let prod_qty = req.query.prod_qty;
    let prod_sched = req.query.radio_group;

    console.log("TEST: " + org_id + prod_id + prod_qty);

    ctrler.addProductToCart(org_id, prod_id, prod_qty, prod_sched, req, res);
});

module.exports = router;