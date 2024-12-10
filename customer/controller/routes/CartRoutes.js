
/**
 * Cart Routes (Express Router)

This module defines the routes for managing the shopping cart in an Express application. 
It includes routes for viewing, updating, and proceeding to checkout or viewing the receipt. 
It also ensures that the cart exists in the session before any operations are performed.

Dependencies
    express: The web application framework used to build the routes.
    cartController: A controller responsible for handling the cart view and actions 
    like adding/removing items.
    checkoutController: A controller responsible for handling the checkout process.
    receiptController: A controller responsible for generating and displaying the 
    receipt after a successful checkout.

Module Export
    This module exports an Express router that is mounted to handle requests related to the shopping cart.
*/

const express = require('express');

const cartController = require('../cart/CartController');
const checkoutController = require('../cart/CheckoutController');
const receiptController = require('../cart/ReceiptController')

const router = express.Router();

router.use((req, res, next) => {
    if (!req.session.cart) {
        req.session.cart = []; 
    }
    next();
});

router.get('/', (req, res) => {
    cartController.index(req,res);
})

router.get('/update', (req,res) => {
    // update quantity and removal of item in cart. to put later
    res.redirect('/cart')
})

router.use('/checkout', (req,res) => {
    checkoutController.index(req, res)
})

router.use('/receipt', (req,res) => {
    receiptController.index(req,res)
})

module.exports = router;
