const model = require('../../model/reservations/Reservations');

var reservations;

const index = (req, res) => {
    const username = req.session.username;

    model.getReservations(username)
    .then(reservations => {
        res.render('reservations/reservations_view',{
            title: "Reservations",
            reservations: reservations
        });
    })
    .catch(err => {
        console.error('Error fetching reservations:', err);
        res.status(500).send('Internal Server Error');
    });
}

module.exports = {
    index
}