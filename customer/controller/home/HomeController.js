const model = require("../../model/home/Home");

// queries
const customerQueries = require("../../model/CustomerQueries");

const index = (req, res) => {
    firstNameQuery = new Promise((resolve, reject) => {
        customerQueries.getFirstName("clifton", (err, results) => {
            if (err) reject(err);
            else resolve(results);
        });
    });

    lastNameQuery = new Promise((resolve, reject) => {
        customerQueries.getLastName("clifton", (err, results) => {
            if (err) reject(err);
            else resolve(results);
        });
    });

    Promise.all([firstNameQuery, lastNameQuery]).then(
        ([firstResults, lastResults]) => {
            const firstName = firstResults.length > 0 ? firstResults[0].first_name : "Unknown";
            const lastName = lastResults.length > 0 ? lastResults[0].last_name : "Unknown";

            res.render("home/home_view", {
                title: "Home",
                sample: model.sample,
                first_name: firstName,
                last_name: lastName,
                bestSellers: []
            });
        }
    );
};

// Insert other methods here

module.exports = {
    index,
    // once a new method has been declared, insert it as an export here and then define it in controller/routes/HomeRoutes
};
