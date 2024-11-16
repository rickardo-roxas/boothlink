const model = require('../../../model/customer/reservations/Reservations');

const index = (req, res) => {

    res.render('reservations/reservations_view', { title : "Reservations", logo : "temp", data : model.data} )

}

module.exports = {
    index
}