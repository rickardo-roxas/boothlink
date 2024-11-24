// const model = require('../../model/cart/Checkout');

const index = (req, res) => {
    res.render('cart/checkout_view',
        {
            title: "Checkout",
        })
}

module.exports = {
    index
}