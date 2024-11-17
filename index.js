const express = require('express')

// express app
const app = express();

// routers
const homeRouter = require('./controller/customer/routes/HomeRoutes');
const reservationsRouter = require('./controller/customer/routes/ReservationRoutes');
const shopRouter = require('./controller/customer/routes/ShopRoutes');
const cartRouter = require('./controller/customer/routes/CartRoutes');

// view engine
app.set("view engine", 'ejs');
app.set('views', "view/customer/");

//port
const port = 3000;

// Listen for requests on port
app.listen(port);

// public files
app.use(express.static('public/css/customer'));
app.use(express.static('assets'));


// Just gives information on the request
app.use((req, res, next) => {
    console.log("host: " + req.hostname);
    console.log("path: " + req.path);
    console.log("method: " + req.method);
    next();
})

// Routes
app.use('/', homeRouter);
app.use('/reservations', reservationsRouter);
app.use('/shop', shopRouter);
app.use('/cart', cartRouter)

// Error Page
app.use((req, res) => {
    res.send("404: Page Not Found.")
});
