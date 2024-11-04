<?php

require __DIR__ . '/../../config/Connection.php';

class VendorQueries {
    protected $conn;
    public function __construct() {
        global $conn;
        $this->conn = $conn;
        if (!isset($conn)) {
            require __DIR__ . '/../../config/Connection.php';
            global $conn;
            $this->conn = $conn;
        }
    }

    // Destructor to close the connection when the object is destroyed
    public function __destruct() {
        $this->conn->close();
    }

    /**
     * Adds a new product to the database with its corresponding vendor and schedule
     */
    public function addProduct($org_id, $sched_id, $category, $description, $prod_serv_name, $price) {
        $stmt = $this->conn->prepare("INSERT INTO prod_serv (org_id, sched_id, category, description, prod_serv_name, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iisssd', $org_id, $sched_id, $category, $description, $prod_serv_name, $price);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Updates the product details in the database
     */
    public function updateProduct($prod_id, $org_id, $sched_id, $category, $description, $prod_serv_name, $price) {
        $stmt = $this->conn->prepare("UPDATE prod_serv SET org_id = ?, sched_id = ?, category = ?, description = ?, prod_serv_name = ?, price = ? WHERE prod_id = ?");
        $stmt->bind_param('iisssdi', $org_id, $sched_id, $category, $description, $prod_serv_name, $price, $prod_id);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Returns all products listed in the database with respect to a vendor
     */
    public function getProducts($org_id) {
        $query = "
        SELECT * FROM prod_serv
        JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id
        WHERE prod_org_sched.org_id = ?
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getProductsByCategory($org_id, $filter){
        $query = "
            SELECT prod_img.img_src, prod_serv.prod_serv_name, prod_serv.price, prod_serv.category, 
                   COUNT(RESERVATION.status='COMPLETED') AS sold, 
                   'In Stock' AS status
            
            FROM prod_serv         
                JOIN prod_org_sched ON PROD_SERV.prod_id = prod_org_sched.prod_id    
                JOIN prod_img ON PROD_SERV.prod_id = prod_img.prod_id     
                LEFT JOIN RESERVATION ON PROD_SERV.prod_id = RESERVATION.prod_id         
                    WHERE prod_org_sched.org_id = ? AND prod_serv.category=?
            GROUP BY prod_serv.prod_serv_name;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $filter);
        $stmt-> execute();
        $result = $stmt-> get_result();
        $stmt->close();

        $products = [];

        if($result){
            $products = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $products;
    }

    public function getProductsByStatus($org_id, $filter){
        $query = "
            SELECT prod_img.img_src, prod_serv.prod_serv_name, prod_serv.price, prod_serv.category, 
                   COUNT(RESERVATION.status='COMPLETED') AS sold, 
                   'In Stock' AS status
            
            FROM prod_serv         
                JOIN prod_org_sched ON PROD_SERV.prod_id = prod_org_sched.prod_id    
                JOIN prod_img ON PROD_SERV.prod_id = prod_img.prod_id     
                LEFT JOIN RESERVATION ON PROD_SERV.prod_id = RESERVATION.prod_id         
                    WHERE prod_org_sched.org_id = ? AND prod_serv.status=?
            GROUP BY prod_serv.prod_serv_name;";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $filter);
        $stmt-> execute();
        $result = $stmt-> get_result();
        $stmt->close();

        $products = [];

        if($result){
            $products = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $products;
    }




    /**
     * Method to get the products given an organization and the associated number of items sold
     */
    public function getProductSales($org_id) {
        $query = "
            SELECT prod_img.img_src, prod_serv.prod_serv_name, prod_serv.price, prod_serv.category, 
                   COUNT(RESERVATION.status='COMPLETED') AS sold, 
                   'In Stock' AS status
            
            FROM prod_serv         
                JOIN prod_org_sched ON PROD_SERV.prod_id = prod_org_sched.prod_id    
                JOIN prod_img ON PROD_SERV.prod_id = prod_img.prod_id     
                LEFT JOIN RESERVATION ON PROD_SERV.prod_id = RESERVATION.prod_id         
                    WHERE prod_org_sched.org_id = ?
            GROUP BY prod_serv.prod_serv_name;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();


        $products = [];
        if ($result) {
            $products = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $products;
    }

    public function getSalesToday($org_id) {
        $query = "SELECT SUM(RESERVATION.qty*PROD_SERV.price) as SOLD_TODAY 
        FROM RESERVATION INNER JOIN PROD_ORG_SCHED ON RESERVATION.prod_id = PROD_ORG_SCHED.prod_id 
	    INNER JOIN SCHEDULE ON PROD_ORG_SCHED.sched_id = SCHEDULE.sched_id 
    	INNER JOIN SALES ON RESERVATION.reservation_id = SALES.reservation_id
        INNER JOIN PROD_SERV ON RESERVATION.prod_id = PROD_SERV.prod_id
    	WHERE SCHEDULE.org_id=? and RESERVATION.date=CURRENT_DATE();";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $sold = 0;
        if ($row = $result->fetch_assoc()) {
            $sold = $row['SOLD_TODAY'] ?: 0; // Ensure to set to 0 if NULL
        }

        return $sold;
    }

    public function getSalesThisWeek($org_id) {
        $query = "SELECT SUM(RESERVATION.qty * PROD_SERV.price) as SOLD_WEEK
        FROM RESERVATION 
        INNER JOIN PROD_ORG_SCHED ON RESERVATION.prod_id = PROD_ORG_SCHED.prod_id 
        INNER JOIN SCHEDULE ON PROD_ORG_SCHED.sched_id = SCHEDULE.sched_id 
        INNER JOIN SALES ON RESERVATION.reservation_id = SALES.reservation_id
        INNER JOIN PROD_SERV ON RESERVATION.prod_id = PROD_SERV.prod_id
        WHERE SCHEDULE.org_id = ?
        AND RESERVATION.date BETWEEN 
            DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) + 1 DAY) AND
            DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) + 1 DAY), INTERVAL 6 DAY)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $sold = 0;

        if ($row = $result->fetch_assoc()) {
            $sold = $row['SOLD_WEEK'] ?: 0; // Ensure to set to 0 if NULL
        }

        return $sold;
    }

    public function getSalesDataPointsForWeek($org_id) {
        $query = "SELECT RESERVATION.date as date, RESERVATION.qty * PROD_SERV.price as amount
        FROM RESERVATION 
        INNER JOIN PROD_ORG_SCHED ON RESERVATION.prod_id = PROD_ORG_SCHED.prod_id 
        INNER JOIN SCHEDULE ON PROD_ORG_SCHED.sched_id = SCHEDULE.sched_id 
        INNER JOIN SALES ON RESERVATION.reservation_id = SALES.reservation_id
        INNER JOIN PROD_SERV ON RESERVATION.prod_id = PROD_SERV.prod_id
        WHERE SCHEDULE.org_id = ?
        AND RESERVATION.date BETWEEN 
            DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) + 1 DAY) AND
            DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) + 1 DAY), INTERVAL 6 DAY);";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $data = null;
        if($result){
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $data;
    }

    public function getReservations($org_id){

        $query = "
        SELECT * 
        FROM organization
        WHERE org_id = ?
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $stmt->close();
        
        return $result ? $result->fetch_assoc() : null; 
    }


    public function getOrganizationByID($org_id) {
        include 'model/objects/Organization.php';
        $query = "SELECT * FROM organization WHERE org_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        if ($row = $result->fetch_assoc()) {
            $organization = new Organization();
            $organization->setName($row['org_name']);
            $organization->setImage($row['org_img']);
            $organization->setFbLink($row['fb_link']);
            $organization->setXLink($row['x_link']);
            $organization->setIgLink($row['ig_link']);
            return $organization;
        }

        return $result;
    }
    
}

// Example usage
// $test = new VendorQueries();
// print_r($test);
