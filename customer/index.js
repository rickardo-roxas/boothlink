const express = require('express')

// express app
const app = express();

// express session
const session = require('express-session');

// routers
const homeRouter = require('./controller/routes/HomeRoutes');
const reservationsRouter = require('./controller/routes/ReservationRoutes');
const shopRouter = require('./controller/routes/ShopRoutes');
const cartRouter = require('./controller/routes/CartRoutes');

// view engine
app.set("view engine", 'ejs');
app.set('views', "view/");
app.set("views cache", true);

//port
const port = 3000;

// Listen for requests on port
app.listen(port);

// public files
app.use(express.static('./public/css'));
app.use(express.static('./shared/assets'));
app.use(express.static('./shared/assets/images/org'));
app.use(express.static('./shared/assets/prod_img'));

// Just gives information on the request
app.use((req, res, next) => {
    console.log("host: " + req.hostname);
    console.log("path: " + req.path);
    console.log("method: " + req.method);
    console.log("url: " + req.baseUrl);
    next();
})

// Session handling
app.use(session({
    secret: "key",
    resave: false,
    saveUninitialized: true,
    cookie: {secure : false}
}));

app.use('/login/:id/:username', (req, res) =>{
    var {id, username} = req.params;
    id = atob(id);
    username = atob(username);
    req.session.customerID=id;
    req.session.username=username;
    res.redirect(`/`);
});

// Routes
app.use((req,res, next) => {
    if (!req.session.customerID || !req.session.username) {
        res.redirect("http://localhost:8080/cs-312_boothlink");
    }    
    next();
});


app.use(`/reservations`, reservationsRouter);
app.use(`/shop`, shopRouter);
app.use(`/cart`, cartRouter)
app.use(`/`, homeRouter);

app.use('/reservations', reservationsRouter);
app.use('/shop', shopRouter);
app.use('/cart', cartRouter)
app.use('/', homeRouter);
app.get('/logout', (req,res) => {
    if (req.session) {
      //  req.session.destroy();
        res.redirect('/cs-312_boothlink/login');
    }
});

// Error Page
app.use((req, res) => {
   // res.redirect("http://localhost:8080/cs-312_boothlink");
});
