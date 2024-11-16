const model = require('../../../model/customer/cart/Cart');

const index = (req, res) => {

    res.render("cart/cart_view", { title : "Home", logo : "temp", sample : model.sample})

}

module.exports = {
    index
}