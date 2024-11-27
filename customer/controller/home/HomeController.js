const model = require("../../model/home/Home");

// queries
const customerQueries = require("../../model/CustomerQueries");

const index = (req, res) => {
    const productsPromiseObj = model.getFiveProducts();
    const boothHome = model.getBooths();

    Promise.all([productsPromiseObj, boothHome]).then(
        ([productsPromiseObj, boothHome]) => {

            res.render("home/home_view", {
                title: "Home",
                sample: model.sample,
                products: productsPromiseObj,
                booths: boothHome
            });
        }
    );
};



// Insert other methods here

module.exports = {
    index,
    // once a new method has been declared, insert it as an export here and then define it in controller/routes/HomeRoutes
};
