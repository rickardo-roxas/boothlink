const express = require('express');

const cartController = require('../cart/CartController');
const checkoutController = require('../cart/CheckoutController');
const receiptController = require('../cart/ReceiptController')

const router = express.Router();


router.use((req, res, next) => {
    if (!req.session.cart) {
        req.session.cart = []; 
    }

    if (!req.session.checkout) {
        req.session.checkout = []
    }

    next();
});

router.get('/', (req, res) => {
    cartController.index(req,res);
})

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
    // Log the request body for debugging
    console.log('Request Body:', req.body);

    // Extract selected products from the request
    const selectedProductsData = req.body['selected-products'];

    // Check if the data is valid
    if (!selectedProductsData) {
        console.error("No selected products found in the request body.");
        return res.status(400).send("Invalid data received.");
    }

    try {
        // Handle both string and array cases
        const selectedProducts = Array.isArray(selectedProductsData)
            ? selectedProductsData.map(productData => JSON.parse(productData))
            : [JSON.parse(selectedProductsData)];

        // Save selected products to session
        req.session.checkout = selectedProducts;

        console.log("Updated Session Checkout:", JSON.stringify(req.session.checkout, null, 2));

        checkoutController.index(req,res) // Redirect to the checkout page
    } catch (error) {
        console.error("Error processing selected products:", error);
        res.status(500).send("An error occurred while processing your request.");
    }
});

router.post('/receipt', (req,res) => {
    receiptController.index(req,res)
})

module.exports = router;
