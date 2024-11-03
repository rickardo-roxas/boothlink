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

// Dummy product data for testing
const dummyProducts = [
    {
        product_name: 'Sample Product 1',
        price: '10.00',
        description: 'Description for Sample Product 1',
        status: 'Available',
        category: 'Item'
    },
    {
        product_name: 'Sample Product 2',
        price: '20.00',
        description: 'Description for Sample Product 2',
        status: 'Out of Stock',
        category: 'Service'
    },
    {
        product_name: 'Sample Product 3',
        price: '15.50',
        description: 'Description for Sample Product 3',
        status: 'Available',
        category: 'Food'
    }
];

// Call the function with dummy data
populateTable(dummyProducts);
