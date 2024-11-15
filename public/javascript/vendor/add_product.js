window.onload = function () {
    var productAdded = sessionStorage.getItem('productAdded');

    // If the product was added, show the alert
    if (productAdded === 'true') {
        alert('Product added successfully!');
        
        // Remove the flag from sessionStorage after showing the alert
        sessionStorage.removeItem('productAdded');
    }
};

// Function to update the product preview
function updatePreview() {
    const name = document.getElementById('name').value.trim();
    const type = document.getElementById('type').value.toUpperCase();
    const priceInput = document.getElementById('price').value;
    const price = isNaN(priceInput) || priceInput === '' ? '0.00' : parseFloat(priceInput).toFixed(2);
    const status = document.getElementById('status').value;
    const descriptionInput = document.getElementById('description').value.trim();

    document.getElementById('preview-name').textContent = name || 'Product Name';
    document.getElementById('preview-type').textContent = type;
    document.getElementById('preview-price').textContent = `Php ${price}`;
    document.getElementById('preview-status').textContent = status;
    document.getElementById('preview-description').textContent = descriptionInput || 'This is a product description.';

    const checkboxes = document.querySelectorAll('.checkbox-group input[type="checkbox"]');
    let selectedDates = [];

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            selectedDates.push(
                checkbox.nextElementSibling ? checkbox.nextElementSibling.textContent : checkbox.parentElement.textContent
            );
        }
    });

    document.getElementById('preview-schedule').textContent = selectedDates.join(', ') || 'Select a schedule';
}


// Function to preview selected images
function previewImages() {
    const fileInput = document.getElementById('file-input');
    const imagePreviewContainer = document.getElementById('image-preview');
    const placeholders = imagePreviewContainer.querySelectorAll('div');
    
    const files = Array.from(fileInput.files).slice(0, 3); // Limit to 3 images
    files.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Replace the placeholder text with an image
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Preview';
            img.className = 'preview-image'; // Class for styling
            
            // If the placeholder exists, replace it with the image
            if (placeholders[index]) {
                placeholders[index].innerHTML = ''; // Clear placeholder text
                placeholders[index].appendChild(img);
            }
        };
        reader.readAsDataURL(file);
    });

    // If fewer than 3 images are uploaded, leave the remaining placeholders
    for (let i = files.length; i < 3; i++) {
        if (placeholders[i]) {
            placeholders[i].textContent = 'Preview Photo'; // Reset placeholder text
        }
    }
}
