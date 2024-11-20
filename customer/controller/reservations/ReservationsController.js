const model = require('../../model/reservations/Reservations');

const index = (req, res) => {

    res.render('reservations/reservations_view.ejs', { title : "Reservations", logo : "temp", data : model.data} )

}

module.exports = {
    index
}