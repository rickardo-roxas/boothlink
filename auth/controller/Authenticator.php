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
            case '/login':
                $title = 'Login';
                if (!isset($_SESSION['user'])) {
                    require ('auth/controller/LoginController.php');
                    $controller = new LoginController($conn);
                    $controller->handleLogin();
                } else {
                    session_destroy();
                    require ('auth/controller/LoginController.php');
                    $controller = new LoginController($conn);
                    $controller->handleLogin();
                    exit();
                }
                break;

            case '/signup':
                $title = 'Signup';
                // Include signup controller and logic if available
                break;

            default:
                echo "404 Not Found";
                break;
        }
        $_SESSION['page_title'] = $title;
    }
}

