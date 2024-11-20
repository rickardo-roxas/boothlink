const model = require('../../model/shop/Shop');

const index = (req, res) => {

    res.render('shop/shop_view', { title : "Shop", logo : "temp", data : model.sample} )

}

module.exports = {
    index
}