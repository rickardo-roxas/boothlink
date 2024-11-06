function populateTable(productList) {
    let table = document.getElementById('product-sales');
    let body = document.getElementById('tbody');

    for (let index in productList) {
        let row = document.createElement('tr');
        row.style.height = "8vh";

        // Product image cell
        let product = document.createElement('td');
        product.classList.add('product-td');

        // Create an img element
        let img = document.createElement('img');
        img.src = "/cs-312_boothlink/assets/prod_img/" + productList[index].img_src;
        img.alt = productList[index].name || "Product Image";
        img.classList.add('product-img'); // Optional: add a class for styling if needed

        // Append the image to the td element
        product.appendChild(img);

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
