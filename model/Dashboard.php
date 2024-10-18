<?php



class Dashboard {

    private $username;

    public function __construct($username) {
        $this -> username = $username;

        $orgPhoto = "../../assets/images/placeholder.jpeg";
        $orgName = "SCHEMA";
        include 'view/vendor/pageFragments/Header.php';
    }

}
