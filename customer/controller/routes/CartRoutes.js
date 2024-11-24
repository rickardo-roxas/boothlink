const express = require('express');

const cartController = require('../cart/CartController');
const checkoutController = require('../cart/CheckoutController');


const router = express.Router();

router.get('/', (req, res) => {
    cartController.index(req,res);
})

router.use('/checkout', (req,res) => {
    checkoutController.index(req, res)
})

module.exports = router;
