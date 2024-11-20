const express = require('express');

const controller = require('../home/HomeController');

const router = express.Router();

router.get('/?/:id/:username', (req, res) =>{
    const {id, username} = req.params;
    req.session.customerID=id;
    req.session.username=username;
    res.redirect("/");
})

router.get('/', (req, res) => {
    if (!req.session.customerID || !req.session.username) {

        res.redirect("http://localhost/cs-312_boothlink");
    } else {
    controller.index(req,res);
    }
})


module.exports = router;
