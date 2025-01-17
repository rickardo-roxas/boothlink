function populateTable(productList) {
    let table = document.getElementById('product-sales');
    let body = document.getElementById('tbody');

    for (let index in productList) {
        let row = document.createElement('tr');
        row.style.height = "8vh";

        // Product cell
        let product = document.createElement('td');
        product.classList.add('product-td');

        let productInfo = document.createElement('div');
        productInfo.classList.add('product-info');

        let img = document.createElement('img');
        img.src = "/shared/assets/prod_img/" + productList[index].img_src;
        img.alt = productList[index].name || "Product Image";
        img.classList.add('product-img');

        let name = document.createElement('span');
        name.classList.add('product-name');
        name.textContent = productList[index].prod_serv_name;

        productInfo.appendChild(img);
        productInfo.appendChild(name);

        product.appendChild(productInfo)

        // Price cell
        let price = document.createElement('td');
        price.innerHTML = "₱ " + productList[index].price + ".00";

        // Category cell
        let category = document.createElement('td');
        category.innerHTML = productList[index].category;

        // Sold cell
        let sold = document.createElement('td');
        sold.innerHTML = productList[index].sold;

        // Status cell
        let status = document.createElement('td');
        status.innerHTML = productList[index].status;

        row.appendChild(product);
        row.appendChild(price);
        row.appendChild(category);
        row.appendChild(sold);
        row.appendChild(status);

        body.appendChild(row);
    }
}

function populateSalesComparison(today, tomorrow) {
    let salesToday = document.getElementById("todayTag");
    salesToday.innerHTML = "₱" + today + ".00";

    let salesWeek = document.getElementById("weekTag");
    salesWeek.innerHTML = "₱" + tomorrow + ".00"
}

function populateChart(xValues, labels) {
        new Chart("sales-chart", {
        type: "bar",
        data: {
        labels: labels,
        datasets: [{
        label: '',
        backgroundColor: "#1EBDEF",
        data: xValues,
    }]
    },
        options: {
        responsive: true,
        scales: {
        y: {
        title: {
        display: true,
        text: 'Amount'
    }
    },
        beginAtZero: true
    },
        legend: {
        display: false
    }
    }
    });
}

let productList = document.getElementById('productList');
let today = document.getElementById('dataSalesToday');
let week = document.getElementById('dataSalesWeek');
let xValues = document.getElementById('dataXValues');
let labels = document.getElementById('dataLabels');

let productsJSON = JSON.parse(productList.value);
let todayJSON = JSON.parse(today.value);
let weekJSON = JSON.parse(week.value);
let xValuesJSON = JSON.parse(xValues.value);
let labelsJSON = JSON.parse(labels.value);

populateTable(productsJSON);
populateSalesComparison(todayJSON, weekJSON);
populateChart(xValuesJSON, labelsJSON);
