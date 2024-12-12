const model = require('../../model/cart/Receipt')

const index = (req, res) => {
    const breadcrumbs = [
        { label: "Cart", link: "/cart" },
        { label: "Checkout", link: "/cart/checkout" },
        { label: "Receipt", link: "/cart/receipt" },
    ];

    const checkoutItems = req.session.checkoutItems || [];

    res.render('cart/receipt_view',
    {
        title: "Receipt",
        breadcrumbs,
        checkoutItems,
    })
}

module.exports = {
    index
}