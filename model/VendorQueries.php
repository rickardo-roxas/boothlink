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
