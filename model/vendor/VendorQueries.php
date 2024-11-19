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
//    public function __destruct() {
//        $this->conn->close();
//    }

    /**
     * Adds a new product to the database with its corresponding vendor 
     * 
     * TO IMPLEMENT: 
     * Image and SchedulePageModel Picking
     * Duplication Checking
     */
    public function addProduct($org_id, $status, $category, $prod_serv_name, $price, $description, $image_src) {
        $schedules = $this->getAllScheduleByWeek();

        if (empty($schedules)) {
            throw new Exception("No schedules found for the current week.");
        }

        $query1 = "
    INSERT INTO prod_serv (status, category, prod_serv_name, price, description)
    VALUES (?, ?, ?, ?, ?)
    ";

        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bind_param('sssds', $status, $category, $prod_serv_name, $price, $description);
        $stmt1->execute();

        // Get the last inserted product ID
        $prod_id = $stmt1->insert_id;
        $stmt1->close();

        $query2 = "
    INSERT INTO prod_img (prod_id, img_src)
    VALUES (?, ?)
    ";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('is', $prod_id, $image_src);
        $stmt2->execute();
        $stmt2->close();

        $query3 = "
    INSERT INTO prod_org_sched (prod_id, org_id, sched_id)
    VALUES (?, ?, ?)
    ";

        $stmt3 = $this->conn->prepare($query3);

        foreach ($schedules as $schedule) {
            $sched_id = $schedule['sched_id'];
            $stmt3->bind_param('iii', $prod_id, $org_id, $sched_id);
            $stmt3->execute();
        }
        $stmt3->close();
    }




    /**
     * Returns all products listed in the database with respect to a vendor
     */
    public function getProducts($org_id) {
        $query = "
    SELECT DISTINCT prod_org_sched.prod_id, 
                    prod_org_sched.org_id, 
                    prod_serv.prod_serv_name, 
                    prod_serv.price, 
                    prod_serv.description, 
                    prod_serv.status, 
                    prod_serv.category
    FROM prod_serv
    JOIN prod_org_sched ON prod_serv.prod_id = prod_org_sched.prod_id
    WHERE prod_org_sched.org_id = ?
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        // Fetch all results as an associative array
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
    public function getProductsByID($prod_id) {
        $query = "SELECT prod_id, prod_serv_name, category, price, status, description FROM prod_serv WHERE prod_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $prod_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public function updateProduct($prod_id, $name, $type, $price, $status, $description) {
        $query = "UPDATE prod_serv SET prod_serv_name = ?, category = ?, price = ?, status = ?, description = ? WHERE prod_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdssi", $name, $type, $price, $status, $description, $prod_id);
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error updating product: " . $stmt->error);
            return false;
        }
    }

    public function deleteProduct($prod_id) {
        $query = "DELETE FROM prod_serv WHERE prod_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $prod_id);
        $stmt->execute();
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
        $query = "SELECT RESERVATION.date as dates, RESERVATION.qty * PROD_SERV.price as amounts
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

    public function getReservations($org_id)
    {
        include 'model/objects/Reservation.php';

        $query = "
        SELECT 
            prod_serv.prod_serv_name AS product_name, 
            reservation.qty AS quantity,
            reservation.date AS date,
            reservation.reservation_id AS id,
            prod_serv.category AS category,
            (reservation.qty * prod_serv.price) AS total_price,
            reservation.status AS status,
            CONCAT(customer.last_name, ', ', customer.first_name) AS customer_name
        FROM organization
        JOIN prod_org_sched ON organization.org_id = prod_org_sched.org_id
        JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id
        JOIN prod_serv ON reservation.prod_id = prod_serv.prod_id
        JOIN customer ON reservation.customer_id = customer.customer_id
        WHERE organization.org_id = ?
        ORDER BY reservation.reservation_id DESC;
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $reservations = [];

        while ($row = $result->fetch_assoc()) {
            $reservation = new Reservation();
            $reservation->setID($row["id"]);
            $reservation->setDate($row['date']);
            $reservation->setProduct($row['product_name']);
            $reservation->setQuantity($row['quantity']);
            $reservation->setCategory($row['category']);
            $reservation-> setPrice($row['total_price']);
            $reservation->setStatus($row['status']);
            $reservation->setCustomer($row['customer_name']);

            $reservations[] = $reservation;
        }

        $stmt->close();
        return $reservations;
    }

    public function getReservationsByStatus($org_id, $status): array {
        include 'model/objects/Reservation.php';

        $query = "SELECT 
            prod_serv.prod_serv_name AS product_name, 
            reservation.qty AS quantity,
            reservation.date AS date,
            reservation.reservation_id AS id,
            prod_serv.category AS category,
            (reservation.qty * prod_serv.price) AS total_price,
            reservation.status AS status,
            CONCAT(customer.last_name, ', ', customer.first_name) AS customer_name
        FROM organization
        JOIN prod_org_sched ON organization.org_id = prod_org_sched.org_id
        JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id
        JOIN prod_serv ON reservation.prod_id = prod_serv.prod_id
        JOIN customer ON reservation.customer_id = customer.customer_id
        WHERE organization.org_id = ?
        AND reservation.status = ?
        ORDER BY reservation.reservation_id DESC;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $status);
        $stmt->execute();

        $result = $stmt->get_result();
        $reservations = [];

        while ($row = $result->fetch_assoc()) {
            $reservation = new Reservation();
            $reservation->setID($row["id"]);
            $reservation->setDate($row['date']);
            $reservation->setProduct($row['product_name']);
            $reservation->setQuantity($row['quantity']);
            $reservation->setCategory($row['category']);
            $reservation->setPrice($row['total_price']);
            $reservation->setStatus($row['status']);
            $reservation->setCustomer($row['customer_name']);

            $reservations[] = $reservation;
        }

        $stmt->close();
        return $reservations;
    }

    public function getOrganizationByID($org_id) {
        include 'model/objects/Organization.php';
    
        $query = "SELECT * FROM organization WHERE org_id = ?";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
    

        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            $organization = new Organization();
            $organization->setName($row['org_name']);
            $organization->setImage($row['org_img']);
            $organization->setFbLink($row['fb_link']);
            $organization->setXLink($row['x_link']);
            $organization->setIgLink($row['ig_link']);
            
            $result->free();
            $stmt->close();
            
            return $organization;
        }
    
        $result->free();
        $stmt->close();
        
        return null;
    }

    public function getOrganizationsByVendorID($vendor_id) {
        $query = "SELECT organization.org_id, organization.org_name, organization.org_img, 
                     organization.fb_link, organization.x_link, organization.ig_link 
              FROM organization 
              INNER JOIN vendor_org ON organization.org_id = vendor_org.org_id 
              WHERE vendor_org.vendor_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $vendor_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }




    public function getAllOrgs() {
        $query = "SELECT org_id, org_name FROM organization";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $organizations = [];
        
        while ($row = $result->fetch_assoc()) {
            $organizations[] = [
                'id' => $row['org_id'],  
                'name' => $row['org_name']
            ]; 
        }
    
        $stmt->close();
        
        return $organizations;
    }

    public function getVendorID($username) {
        $query = "SELECT vendor_id FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['vendor_id'];
        }
        return null;
    }


    public function getRecentReservations($org_id, $date): array
    {
        include 'model/objects/Reservation.php';
        $query = "SELECT prod_org_sched.*, reservation.*, customer.last_name, prod_serv.prod_serv_name, prod_serv.price
            FROM prod_org_sched
            JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id
            JOIN customer ON customer.customer_id = reservation.customer_id
            JOIN prod_serv ON reservation.prod_id = prod_serv.prod_id
            WHERE prod_org_sched.org_id = ? 
            AND reservation.date = ?
            ORDER BY reservation.date ASC 
            LIMIT 5;";


        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $reservations = [];
        if ($row = $result->fetch_assoc()) {
            $reservation = new Reservation();
            $reservation->setID($row['reservation_id']);
            $reservation->setCustomer($row['last_name']);
            $reservation->setProduct($row['prod_serv_name']);

            $totalPrice = $row['price'] * $row['qty'];
            $reservation->setPrice($totalPrice);

            $reservation->setQuantity($row['qty']);
            $reservation->setDate($row['date']);
            $reservation->setStatus($row['status']);

            $reservations[] = $reservation;
        }

        $stmt->close();
        return $reservations;
    }

    public function getScheduleToday($org_id, $date): array
    {
        include 'model/objects/Schedule.php';
        $query = "SELECT prod_org_sched.org_id, schedule.*, location.loc_room, location.stall_number
            FROM prod_org_sched
            JOIN schedule ON schedule.sched_id = prod_org_sched.sched_id
            JOIN location ON location.loc_id = schedule.loc_id
            WHERE prod_org_sched.org_id = ?
            AND schedule.date = ?
            ORDER BY schedule.sched_id ASC;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();
        $schedules = [];

//        if ($row = $result->fetch_assoc()) {
//            $schedule = new SchedulePageModel();
//            $schedule->setDate($row['date']);
//            $schedule->setStartTime($row['start_time']);
//            $schedule->setEndTime($row['end_time']);
//            $schedule->setLocationRoom($row['loc_room']);
//            $schedule->setLocationStallNum($row['stall_number']);
//
//            $schedules[] = $schedule;
//        }

        $stmt->close();
        return $schedules;
    }

    public function getPendingReservationsCount($org_id, $date) {
        $query = "SELECT COUNT(*) AS count
            FROM prod_org_sched
            JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id 
            WHERE prod_org_sched.org_id = ?
            AND reservation.date = ? 
            AND reservation.status = 'Pending';";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
        }
        $stmt->close();

        return $count;
    }

    public function getCompletedReservationsCount($org_id, $date) {
        $query = "SELECT COUNT(*) AS count 
            FROM prod_org_sched
            JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id 
            WHERE prod_org_sched.org_id = ?
            AND reservation.date = ? 
            AND reservation.status = 'Completed';";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
        }
        $stmt->close();

        return $count;

        $stmt->close();

        return $result;
    }

    public function getTotalReservationsCount($org_id, $date) {
        $query = "SELECT COUNT(*) AS count
            FROM prod_org_sched
            JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id 
            WHERE prod_org_sched.org_id = ?
            AND reservation.date = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
        }
        $stmt->close();

        return $count;
        $stmt->close();

        return $result;
    }

    public function getItemReservationsCount($org_id, $date) {
        $query = "SELECT COUNT(*) AS count
            FROM prod_org_sched
            JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id
            INNER JOIN prod_serv ON reservation.prod_id = prod_serv.prod_id
            WHERE prod_org_sched.org_id = ?
            AND reservation.date = ? 
            AND prod_serv.category = 'Item';";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
        }
        $stmt->close();

        return $count;
    }

    public function getFoodReservationsCount($org_id, $date) {
        $query = "SELECT COUNT(*) AS count
            FROM prod_org_sched
            JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id
            INNER JOIN prod_serv ON reservation.prod_id = prod_serv.prod_id
            WHERE prod_org_sched.org_id = ?
            AND reservation.date = ? 
            AND prod_serv.category = 'Food';";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
        }
        $stmt->close();

        return $count;

        $stmt->close();

        return $result;
    }

    public function getServiceReservationsCount($org_id, $date) {
        $query = "SELECT COUNT(*) AS count
            FROM prod_org_sched
            JOIN reservation ON reservation.prod_id = prod_org_sched.prod_id
            INNER JOIN prod_serv ON reservation.prod_id = prod_serv.prod_id
            WHERE prod_org_sched.org_id = ?
            AND reservation.date = ? 
            AND prod_serv.category = 'Service';";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $org_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
        }
        $stmt->close();

        return $count;

        $stmt->close();

        return $result;
    }

    public function addSchedule($date, $startTime, $endTime, $loc_id): void {
        $query = "INSERT INTO schedule (date, start_time, end_time, loc_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $date, $startTime, $endTime, $loc_id);
        $stmt->execute();
        $stmt->close();
    }

    public function getSchedules($org_id) {
        include 'model/objects/Schedule.php';
        $query = "SELECT prod_org_sched.org_id, schedule.*, location.loc_room, location.stall_number 
            FROM prod_org_sched
            JOIN schedule ON schedule.sched_id = prod_org_sched.sched_id
            JOIN location ON location.loc_id = schedule.loc_id
            WHERE org_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $org_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $schedules = [];

        while ($row = $result->fetch_assoc()) {
            $schedule = new SchedulePageModel();
            $schedule->setDate($row['date']);
            $schedule->setStartTime($row['start_time']);
            $schedule->setEndTime($row['end_time']);
            $schedule->setLocationRoom($row['loc_room']);
            $schedule->setLocationStallNum($row['stall_number']);

            $schedules[] = $schedule->toArray();
        }

        $stmt->close();
        return $schedules;
    }

    public function getSchedule($org_id, $date, $startTime, $endTime, $loc_id) {
        include 'model/objects/Schedule.php';
        $query = "SELECT prod_org_sched.org_id, schedule.*,
        FROM prod_org_sched
        JOIN schedule ON schedule.sched_id = prod_org_sched.sched_id
        WHERE prod_org_sched.org_id = ?
        AND schedule.date = ?
        AND schedule.start_time = ?
        AND schedule.end_time = ?
        AND loc_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssi", $org_id, $date, $startTime, $endTime, $loc_id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;
    }

    public function getScheduleThisWeek($org_id, $startDate, $endDate) {
        include 'model/objects/Schedule.php';
        $query = "SELECT prod_org_sched.org_id, schedule.*, location.loc_room, location.stall_number 
            FROM prod_org_sched
            JOIN schedule ON schedule.sched_id = prod_org_sched.sched_id
            JOIN location ON location.loc_id = schedule.loc_id
            WHERE prod_org_sched.org_id = ?
            AND schedule.date BETWEEN ? AND ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $org_id, $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $schedules = [];

        while ($row = $result->fetch_assoc()) {
            $schedule = new Schedule();
            $schedule->setDate($row['date']);
            $schedule->setStartTime($row['start_time']);
            $schedule->setEndTime($row['end_time']);
            $schedule->setLocationRoom($row['loc_room']);
            $schedule->setLocationStallNum($row['stall_number']);

            $schedules[] = $schedule->toArray();
        }

        $stmt->close();
        return $schedules;
    }

    public function cancelReservation($reservation_id) {
        $query = "UPDATE reservation SET status = 'Cancelled' WHERE reservation_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
        $isUpdated = $stmt->affected_rows > 0;
        $stmt->close();
        return $isUpdated;
    }

    public function completeReservation($reservation_id) {
        $query = "UPDATE reservation SET status = 'Completed' WHERE reservation_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
        $isUpdated = $stmt->affected_rows > 0;
        $stmt->close();
        return $isUpdated;
    }

    public function getAllScheduleByWeek() {
        $query = "SELECT sched_id, date, start_time, end_time 
              FROM schedule 
              WHERE WEEK(date, 1) = WEEK(CURDATE(), 1) 
              AND YEAR(date) = YEAR(CURDATE())";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $schedules = $result->fetch_all(MYSQLI_ASSOC);
        return $schedules;
    }

}

// Example usage
// $test = new VendorQueries();
// print_r($test);
