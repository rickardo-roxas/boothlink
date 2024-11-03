// Function to populate the table with products
function populateTable(products) {
    const tbody = document.querySelector('.table-products tbody');
    tbody.innerHTML = ''; // Clear existing rows

    products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.prod_serv_name}</td>
            <td>${product.price}</td>
            <td>${product.description}</td>
            <td>${product.status}</td>
            <td>${product.category}</td>
            <td>
                <button>Edit</button>
                <button>Delete</button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Get the hidden input element
let productsDataElement = document.getElementById('products-data');

// Parse the JSON data from the hidden input
let products = JSON.parse(productsDataElement.value);

populateTable(products);