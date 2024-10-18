<?php 
class VendorQueries{
    public function addProduct($org_id, $sched_id, $category, $description, $prod_serv_name, $price) {
        include 'Connection.php';
        $stmt = $conn->prepare("INSERT INTO prod_serv (org_id, sched_id, category, description, prod_serv_name, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iisssd', $org_id, $sched_id, $category, $description, $prod_serv_name, $price);
        $stmt->execute();
        //close
        $stmt->close();
        $conn->close();

    }

    public function updateProduct($prod_serv_id, $org_id, $sched_id, $category, $description, $prod_serv_name, $price){
        include 'Connection.php';
        $stmt = $conn->prepare("UPDATE prod_serv SET org_id = ?, sched_id = ?, category = ?, description = ?, prod_serv_name = ?, price = ? WHERE prod_serv_id = ?");
        $stmt->bind_param('iisssdi', $org_id, $sched_id, $category, $description, $prod_serv_name, $price, $prod_serv_id);
        $stmt->$execute();
        //close
        $stmt->close();
        $conn->close();
    }
}