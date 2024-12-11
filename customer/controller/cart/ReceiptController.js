// const model = require('../../model/cart/Receipt')

const index = (req, res) => {
    const breadcrumbs = [
        { label: "Cart", link: "/cart" },
        { label: "Checkout", link: "/cart/checkout" },
        { label: "Receipt", link: "/cart/receipt" },
    ];

    res.render('cart/receipt_view',
    {
        title: "Receipt",
        breadcrumbs
    })
}

module.exports = {
    index
}