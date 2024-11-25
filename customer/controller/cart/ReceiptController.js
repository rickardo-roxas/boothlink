// const model = require('../../model/cart/Receipt')

const index = (req, res) => {
    res.render('cart/receipt_view',
    {
        title: "Receipt",
    })
}

module.exports = {
    index
}