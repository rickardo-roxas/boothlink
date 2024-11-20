const model = require('../../model/cart/Cart');

const index = (req, res) => {

    res.render("cart/cart_view", { title : "Home", logo : "temp", sample : model.sample})

}

module.exports = {
    index
}