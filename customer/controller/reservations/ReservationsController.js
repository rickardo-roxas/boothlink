const model = require('../../model/reservations/Reservations');

var reservations;

/**
 * Author: Jasmin, Ramon Emmiel P.
 * Description: This index renders the page via Promise from the model. To display the products, the 'filter' input is first checked
 * whether it has a value, if not, then all products are displayed.
 * @param {*} req 
 * @param {*} res 
 */
const index = (req, res) => {
    const username = req.session.username;
    const filter = req.query.filter || 'All'; // Default to 'All' if no filter is provided

    // If no filter is selected, get all reservations; otherwise, get filtered reservations by status
    if (filter === 'All') {
        model.getReservations(username)
            .then(reservations => {
                res.render('reservations/reservations_view', {
                    title: "Reservations",
                    reservations: reservations,
                    filter: filter
                });
            })
            .catch(err => {
                console.error('Error fetching reservations:', err);
                res.status(500).send('Internal Server Error');
            });
    } else {
        model.getReservationsByStatus(filter, username)
            .then(reservations => {
                res.render('reservations/reservations_view', {
                    title: "Reservations",
                    reservations: reservations,
                    filter: filter
                });
            })
            .catch(err => {
                console.error('Error fetching reservations:', err);
                res.status(500).send('Internal Server Error');
            });
    }
}

module.exports = {
    index
}
