
const model = require("../../../model/customer/home/Home")

const index = (req, res) => {

    res.render("home/home_view", { title : "Home", logo : "temp", sample : model.sample})
}

// Insert other methods here

module.exports = {
    index 
    // once a new method has been declared, insert it as an export here and then define it in controller/routes/HomeRoutes
}


