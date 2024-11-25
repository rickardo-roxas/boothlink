const express = require('express');

const controller = require ('../reservations/ReservationsController')

const router = express.Router();

router.get('/', (req, res) => {
    controller.index(req,res);
});
module.exports = router;