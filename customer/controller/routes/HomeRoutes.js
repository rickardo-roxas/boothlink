/**
Home Route (Express Router)

This module defines the route for the home page of the application. 
It handles HTTP requests to the root path (/) and invokes a controller 
method to render or return the home page content.

Dependencies
    express: The web application framework used to build the routes.
    controller: A reference to the HomeController that contains the logic for 
    rendering the home page.

Module Export
    This module exports an Express router that is mounted to handle requests for the home page.
 */
const express = require('express');

const controller = require('../home/HomeController');

const router = express.Router();

router.get('/', (req, res) => {
    controller.index(req,res);
});


module.exports = router;
