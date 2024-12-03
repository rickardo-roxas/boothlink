const model = require('../../model/cart/Cart');

const index = (req, res) => {

    const breadcrumbs = [
        { label: "Cart", link: "/cart" },
    ];

    Promise.all().then(
        res.render("cart/cart_view", 
        {
            title : "Cart",
            breadcrumbs 

        })
    )
    
}

module.exports = {
    index
}