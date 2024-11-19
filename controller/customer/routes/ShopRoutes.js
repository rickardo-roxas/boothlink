const express = require('express');

const controller = require ('../shop/ShopController')

const router = express.Router();

router.get('/', (req, res) => {
    switch (req.body.title) {
        case "price":
            break;
        case "category":
            break;
        default:
            res.redirect("/");
    }
    controller.index(req,res);
});

router.post('/', (req,res) => {
    if (req.body.action == "Add to Cart") {
        const item = [req.body.productID, req.body.quantity];
        req.session.cart.push(item);
    }
});
module.exports = router;