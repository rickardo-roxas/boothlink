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

// router.post('/update', (req,res) => {
//     // update quantity and removal of item in cart. to put later
//     res.redirect('/cart')
// })

router.get('/remove', (req,res) => {
    let productId = parseInt(req.query.product_id);
    if (isNaN(productId)) {
        console.error('Invalid product_id:', req.query.product_id);
        return res.redirect('/cart');
    }
    cartController.removeItem(productId, req, res);
})

router.post('/clear', (req,res) => {
    req.session.cart = []
    res.redirect('/cart')
})

router.post('/checkout', (req, res) => {
    const selectedProductIds = req.body['selected-products'];
    res.redirect('checkout')
});


router.get('/receipt', (req,res) => {
    receiptController.index(req,res)
})

module.exports = router;
