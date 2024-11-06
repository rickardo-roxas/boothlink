// Function to populate the table with products
function populateTable(products) {
    const tbody = document.querySelector('.table-products tbody');
    tbody.innerHTML = ''; // Clear existing rows

    products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.prod_serv_name}</td>
            <td>₱ ${product.price}.00</td>
            <td>${product.description}</td>
            <td>${product.status}</td>
            <td>${product.category}</td>
             <td>
               <button class="btn-file" onclick="redirectToEdit(${product.prod_id})">Edit</button>
                <form action="/cs-312_boothlink/products/delete-product" method="POST" style="display:inline;">
                  <input type="hidden" name="prod_id" value="${product.prod_id}">
                  <button class="btn-file" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
             </td>

        `;
        tbody.appendChild(row);
    });
}

// Redirect to edit page function
function redirectToEdit(prod_id) {
    // Redirect to the edit page with the product ID as a query parameter
    window.location.href = `/cs-312_boothlink/products/edit-product?prod_id=${prod_id}`;
}




// Get the hidden input element
let productsDataElement = document.getElementById('products-data');

// Parse the JSON data from the hidden input
let products = JSON.parse(productsDataElement.value);

populateTable(products);
