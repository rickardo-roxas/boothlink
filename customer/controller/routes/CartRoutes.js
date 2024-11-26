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
