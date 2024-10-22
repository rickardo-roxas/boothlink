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
        SELECT prod_serv.* FROM prod_serv
        JOIN prod_org_sched ON prod_serv.prod_serv_id = prod_org_sched.prod_id
        WHERE prod_org_sched.org_id = ?
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    /**
     * @param $org_id
     * @return array|mixed
     * Method to get the products given an organization and the associated number of items sold
     */
    public function getProductSales($org_id) {
        include 'Connection.php';

        $query = "
            SELECT prod_img.img_src, prod_serv.prod_serv_name, prod_serv.price, prod_serv.category, 
                   COUNT(RESERVATION.status='COMPLETED') AS sold, 
                   'In Stock' AS status
            
            FROM prod_serv         
                JOIN prod_org_sched ON prod_serv.prod_serv_id = prod_org_sched.prod_id    
                JOIN prod_img ON prod_serv.prod_serv_id = prod_img.prod_serv_id     
                LEFT JOIN RESERVATION ON PROD_SERV.prod_serv_id = RESERVATION.product_id         
                    WHERE prod_org_sched.org_id = ?
            GROUP BY prod_serv.prod_serv_name;";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt-> execute();
        $result = $stmt-> get_result();
        $stmt->close();
        $conn->close();

        $products = [];

        if($result){
            $products = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $products;
    }

    public function getSalesToday($org_id) {
        include 'Connection.php';
        $query = "SELECT SUM(RESERVATION.qty*PROD_SERV.price) as SOLD_TODAY from RESERVATION 
        JOIN PROD_SERV ON RESERVATION.product_id = PROD_SERV.prod_serv_ID
        JOIN PROD_ORG_SCHED ON PROD_SERV.prod_serv_ID = PROD_ORG_SCHED.prod_id
        WHERE org_id=? and RESERVATION.date=CURRENT_DATE();";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        $sold = 0;

        if ($row = $result->fetch_assoc()) {
            $sold = $row['SOLD_TODAY'] ?: 0; // Ensure to set to 0 if NULL
        }

        return $sold;

    }

    public function getReservations($org_id){
        include 'Connection.php';

        $query = "
        SELECT reservation.* FROM reservation
        WHERE org_id = ?
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        return $result;
    }

    
}