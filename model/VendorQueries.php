<?php 

include 'Connection.php';

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
} else {
    echo "Successfully connected!";
}

function addProduct($org_id,$sched_id,$category,$description,$prod_serv_name,$price) {
    global $conn; // must be global to access the conn inside the function

    $stmt = $conn->prepare("INSERT INTO prod_serv (org_id, sched_id, category, description, prod_serv_name, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('iisssd', $org_id,$sched_id,$category,$description,$prod_serv_name,$price);//iisssd means i = int , s= string, d = double

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Test the function
// addProduct(3,2,'entertainment','Electric Chair','Alawakbar', 15000.55);
?>

<?php

function updateProduct($prod_serv_id, $org_id, $sched_id, $category, $description, $prod_serv_name, $price) {
    global $conn;

    $stmt = $conn->prepare("UPDATE prod_serv SET org_id = ?, sched_id = ?, category = ?, description = ?, prod_serv_name = ?, price = ? WHERE prod_serv_id = ?");
    
    $stmt->bind_param('iisssdi', $org_id, $sched_id, $category, $description, $prod_serv_name, $price, $prod_serv_id);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Example call to the function
updateProduct(1, 3, 2, 'Clothing', 'Updated description', 'INC Clothing Tee', 400.50);

?>
