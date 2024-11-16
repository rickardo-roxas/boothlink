const express = require('express');

const controller = require ('../shop/ShopController')

const router = express.Router();

router.get('/', (req, res) => {
    controller.index(req,res);
})

module.exports = router;