<?php 
class VendorQueries{

    /**
     * Adds a new product to the database with its corresponding vendor and schedule
     */
    public function addProduct($org_id, $sched_id, $category, $description, $prod_serv_name, $price) {
        include 'Connection.php';
        $stmt = $conn->prepare("INSERT INTO prod_serv (org_id, sched_id, category, description, prod_serv_name, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iisssd', $org_id, $sched_id, $category, $description, $prod_serv_name, $price);
        $stmt->execute();
        //close
        $stmt->close();
        $conn->close();

    }

    /**
     * Updates the product details in the database
     */
    public function updateProduct($prod_serv_id, $org_id, $sched_id, $category, $description, $prod_serv_name, $price){
        include 'Connection.php';
        $stmt = $conn->prepare("UPDATE prod_serv SET org_id = ?, sched_id = ?, category = ?, description = ?, prod_serv_name = ?, price = ? WHERE prod_serv_id = ?");
        $stmt->bind_param('iisssdi', $org_id, $sched_id, $category, $description, $prod_serv_name, $price, $prod_serv_id);
        $stmt->execute();
        //close
        $stmt->close();
        $conn->close();
    }

    /**
     * UNTESTED
     * Returns all products listed in the database with respect to a vendor
     */
    public function getProducts($org_id){
        include 'Connection.php';

        $query = "
        SELECT * FROM prod_serv
        JOIN schedule ON prod_serv.sched_id = schedule.sched_id
        WHERE schedule.org_id = ?
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        return $result;
    }

    
}