<?php
include '../../config/Connection.php';

class VendorQueries {
    protected $conn;
    public function __construct() {
        global $conn;
        $this->conn = $conn;
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
    
        // Fetch all results as an associative array
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : []; 
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
                JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id    
                JOIN prod_img ON prod_serv.prod_id = prod_img.prod_id     
                LEFT JOIN RESERVATION ON prod_serv.prod_id = RESERVATION.prod_id         
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
        $query = "SELECT SUM(RESERVATION.qty * prod_serv.price) as SOLD_TODAY from RESERVATION 
        JOIN prod_serv ON RESERVATION.prod_id = prod_serv.prod_id
        JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id
        WHERE org_id = ? and RESERVATION.date = CURRENT_DATE();";

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

    public function getReservations($org_id) {
        $query = "
            SELECT 
                pos.org_id,  
                r.* 
            FROM 
                prod_org_sched pos
            JOIN 
                reservation r ON pos.prod_id = r.prod_id
            WHERE 
                pos.org_id = ?
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id); // Assuming org_id is an integer
        $stmt->execute();
    
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch results as associative array
        $stmt->close();
    
        return $result;
    }
    
    

    public function getProductByID($prod_id) {
        $query = "
        SELECT prod_serv_name, category, price, status, description   
        FROM prod_serv 
        WHERE prod_id = ?
        ";
        $stmt = $this->conn->prepare($query);

        
        $stmt->bind_param("i", $prod_id);
        $stmt->execute();
    
        $result = $stmt->get_result(); 
        $stmt->close();
    
        return $result ? $result->fetch_assoc() : null;
    }
    

    public function getOrgByID($org_id) {

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
        
        return $result ? $result->fetch_assoc() : null; // Return null if no result found
    }


    public function getAllOrgs() {
        $query = "
        SELECT *
        FROM organization
        ";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        
        $result = $stmt->get_result();
    
        $stmt->close();
    
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];   
    }
    
}

// Example usage
$test = new VendorQueries();
print_r($test); 