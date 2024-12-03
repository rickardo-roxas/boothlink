// const model = require('../../model/cart/Checkout');

const index = (req, res) => {
    const breadcrumbs = [
        { label: "Cart", link: "/cart" },
        { label: "Checkout", link: `/cart/checkout` },
    ];

    res.render('cart/checkout_view',
        {
            title: "Checkout",
            breadcrumbs
        })
}

module.exports = {
    index
}