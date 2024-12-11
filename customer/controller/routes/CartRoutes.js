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
    if (!req.session.checkout) {
        req.session.checkout = []
    }
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
    if (!req.session.checkout) {
        req.session.checkout = []
    }

    console.log('Request Body:', req.body);
    let checkout = req.session.checkout;

    const selectedProducts = req.body['selected-products'];

    if (!selectedProducts) {
        console.error("No selected products found in the request body.");
    }

    cartController.addToCheckout(selectedProducts, req, res)

    console.log("Updated Session Checkout:", JSON.stringify(checkout, null, 2));

    checkoutController.index(req,res) 
});

router.post('/receipt', (req, res) => {
    if (!req.session.checkout) {
        req.session.checkout = [];
    }

    const checkoutItems = req.session.checkout;

    const reservationPromises = checkoutItems.map(item => {
        const { product_id, product_qty, product_sched } = item; 

        return checkoutController.createReservation(req.session.username, product_id, product_sched, product_qty);
    });

    Promise.all(reservationPromises)
        .then(() => {
            // After all reservations are created, clear the checkout session
            req.session.checkout = [];

            receiptController.index(req, res);
        })
        .catch(error => {
            console.error("Error creating reservations:", error);
            res.status(500).send("Error creating reservation.");
        });
});

module.exports = router;


module.exports = router;
