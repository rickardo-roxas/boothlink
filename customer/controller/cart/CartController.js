const model = require('../../model/cart/Cart');

const index = (req, res) => {
    if (!req.session.cart) {
        req.session.cart = [];
    }

    let cartProductsPromise = model.getCart(req.session);

    cartProductsPromise.then(cartProducts => {
        console.log("Cart products:", JSON.stringify(cartProducts, null, 2)); 

        let orgProducts = {}; 

        let productDetailsPromise = cartProducts.map(product => {
            const prod_id = parseInt(product.prod_id); 
            console.log("Processing product with prod_id:", prod_id); 

            return getProdDetails(prod_id).then(productDetails => {
                let orgName = productDetails.org_name;

                if (!orgProducts[orgName]) {
                    orgProducts[orgName] = [];
                }

                let productWithDetails = {
                    id: prod_id, 
                    quantity: product.quantity,
                    name: productDetails.prod_serv_name,
                    image: productDetails.img_src,
                    price: productDetails.price,
                    schedules: [], 
                    selectedSchedule: product.schedule, 
                };

                return getSchedules(prod_id)
                    .then(schedules => {
                        productWithDetails.schedules = schedules || []; 
                        orgProducts[orgName].push(productWithDetails);
                    });
            });
        });

        Promise.all(productDetailsPromise).then(() => {
            const breadcrumbs = [
                {label: "Cart", link: "/cart"},
            ];

            res.render("cart/cart_view", {
                title: "Cart",
                breadcrumbs,
                orgProducts,
                formatDateTime,
                removeItem,
            })
        })
    })
}

function addToCheckout(selectedItems, req, res) {
    if (!Array.isArray(selectedItems) || selectedItems.length === 0) {
        console.error("No items selected for checkout.");
        res.redirect('/cart');
        return;
    }

    const product = {
        product_id: parseInt(prod_id),
        product_qty: parseInt(prod_qty),
        product_sched : parseInt(prod_sched)
    };

    if (!req.session.checkout) {
        req.session.checkout = [];
    }

    selectedItems.forEach(item => {
        const { org_id, product_id, product_qty, product_sched } = item;

        const product = {
            product_id: parseInt(product_id),
            product_qty: parseInt(product_qty),
            product_sched: parseInt(product_sched),
        };

        let org = req.session.checkout.find(org => org.org_id === org_id);

        if (!org) {
            org = {
                org_id: org_id,
                products: [],
            };
            req.session.checkout.push(org);
        }

        let cartProduct = org.products.find(prod => prod.product_id === product.product_id);

        if (cartProduct) {
            cartProduct.product_qty += product.product_qty;
            cartProduct.product_sched = product.product_sched;
        } else {
            org.products.push(product);
        }
    });

    console.log("Updated Session Cart:", JSON.stringify(req.session.cart, null, 2));
    res.redirect('/cart'); // To change to an alert message
}

function getProdDetails(id) {
    return model.getProductInfo(id)
}

function getSchedules(id) {
    return model.getSchedules(id)
}

function formatDateTime(dateStr, timeStr) {
    const date = new Date(dateStr);
    const hours = parseInt(timeStr.split(':')[0]);
    const minutes = timeStr.split(':')[1];
    
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 || 12;  
    const formattedTime = `${formattedHours}:${minutes} ${ampm}`;
    
    const month = date.toLocaleString('default', { month: 'short' });
    const day = date.getDate();
    const year = date.getFullYear();

    return `${month} ${day}, ${year} - ${formattedTime}`;
}

function removeItem(product_id, req, res) {
    const prod_id = parseInt(product_id); 
    if (isNaN(prod_id)) {
        console.error("Invalid product ID");
        return res.redirect("/cart"); 
    }

    req.session.cart = req.session.cart.map(org => {
        return {
            ...org,
            products: org.products.filter(product => product.product_id !== prod_id)
        };
    }).filter(org => org.products.length > 0); // Remove organizations with no products

    res.redirect("/cart");
}

module.exports = {
    index,
    getProdDetails,
    getSchedules,
    formatDateTime,
    removeItem,
}