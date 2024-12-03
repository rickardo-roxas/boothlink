const model = require('../../model/cart/Cart');

const index = (req, res) => {
    let cartPromise

    const breadcrumbs = [
        { label: "Cart", link: "/cart" },
    ];

    Promise.all().then(
        res.render("cart/cart_view", 
        {
            title : "Cart", 

        })
    )
    
}

module.exports = {
    index
}