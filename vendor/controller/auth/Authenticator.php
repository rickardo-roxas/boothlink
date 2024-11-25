<?php

namespace controller\auth;

class Authenticator
{
    /**
     * Renders the Authentication view of a given webpage passed from the router.
     * @param $path - The path passed from the Router.
     * @param $conn - Database connection.
     * @return void
     */
    public function renderAuth($path, $conn)
    {
        $title = '';

        switch ($path) {
            case '/cs-312_boothlink/signup':
                $title = 'Signup';
                require('controller/auth/SignupController.php');
                $controller = new SignupController($conn);
                $controller->handleSignup();
                exit();

            default:
                $title = 'Login';
                if (!isset($_SESSION['user'])) {
                    require('controller/auth/LoginController.php');
                    $controller = new LoginController($conn);
                    $controller->handleLogin();
                } else {
                    session_destroy();
                    require('controller/auth/LoginController.php');
                    $controller = new LoginController($conn);
                    $controller->handleLogin();
                    exit();
                }
                break;
        }
        $_SESSION['page_title'] = $title;
    }
}

