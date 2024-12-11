/**
Reservations Route (Express Router)

This module defines the route for handling reservation-related requests. 
Specifically, it handles the HTTP GET request to the root path (/) under the 
/reservations path, which displays a list of or allows interaction with reservations.

Dependencies
    express: The web application framework used to create the routes.
    controller: A reference to the ReservationsController, which contains 
    the logic for managing reservations (e.g., displaying a list, adding, editing, 
        or deleting reservations).

    Module Export
This module exports an Express router that is used to handle requests for reservations.
 */
const express = require('express');

const controller = require ('../reservations/ReservationsController')

const router = express.Router();

router.get('/', (req, res) => {
    controller.index(req,res);
});
module.exports = router;