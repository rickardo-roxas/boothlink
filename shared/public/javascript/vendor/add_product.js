window.onload = function () {
    const productAdded = sessionStorage.getItem('productAdded');

    if (productAdded === 'true') {
        alert('Product added successfully!');
        sessionStorage.removeItem('productAdded');
    }

    setupScheduleSelection();
};

// Function to update the product preview
function updatePreview() {
    const name = document.getElementById('name').value.trim();
    const type = document.getElementById('type').value.toUpperCase();
    const priceInput = document.getElementById('price').value;
    const price = isNaN(priceInput) || priceInput === '' ? '0.00' : parseFloat(priceInput).toFixed(2);
    const status = document.getElementById('status').value;
    const descriptionInput = document.getElementById('description').value.trim();

    // Update product information
    document.getElementById('preview-name').textContent = name || 'Product Name';
    document.getElementById('preview-type').textContent = type || 'Select Category';
    document.getElementById('preview-price').textContent = `Php ${price}`;
    document.getElementById('preview-status').textContent = status || 'Select Status';
    document.getElementById('preview-description').textContent = descriptionInput || 'Input description.';

    // Update schedule preview
    const selectedSchedules = [];
    const scheduleCheckboxes = document.querySelectorAll('.schedule-table tbody input[type="checkbox"]:checked');

    scheduleCheckboxes.forEach((checkbox) => {
        const row = checkbox.closest('tr');
        const date = row.children[1].textContent.trim();
        const location = row.children[2].textContent.trim(); 
        const stallNo = row.children[3].textContent.trim();
        const startTime = row.children[4].textContent.trim();
        const endTime = row.children[5].textContent.trim();

        selectedSchedules.push(
            `<div>Date:<span class="schedule-label"> ${date}</span></div>
            <div>Location:<span class="schedule-label"> ${location}</span></div>
            <div>Stall No.:<span class="schedule-label"> ${stallNo}</span></div>
            <div>Time:<span class="schedule-label"> ${startTime} - ${endTime}</span></div>`
        );
        
    });

    document.getElementById('preview-schedule').innerHTML = selectedSchedules.join(', ') || 'Select a schedule';
}

// Highlight selected row
function setupScheduleSelection() {
    const scheduleCheckboxes = document.querySelectorAll('.schedule-table tbody input[type="checkbox"]');

    scheduleCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            const row = this.closest('tr');
            if (this.checked) {
                // Highlight 
                row.classList.add('selected-row');
            } else {
                // Remove highlight 
                row.classList.remove('selected-row');
            }
            updatePreview();
        });
    });
}

// Function to preview selected images
function previewImages() {
    const fileInput = document.getElementById('file-input');
    const imagePreviewContainer = document.getElementById('image-preview');
    const placeholders = imagePreviewContainer.querySelectorAll('div');
    
    const files = Array.from(fileInput.files).slice(0, 3); 
    files.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Preview';
            img.className = 'preview-image'; 
            
            if (placeholders[index]) {
                placeholders[index].innerHTML = ''; 
                placeholders[index].appendChild(img);
            }
        };
        reader.readAsDataURL(file);
    });

}
