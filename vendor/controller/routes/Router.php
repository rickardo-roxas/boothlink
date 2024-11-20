<?php

namespace controller\core;
/**
 * Handles requests and maps to respective controllers.
 */
class Router
{
    /**
     * @var array Holds HTTP methods and maps the paths to the handler function.
     */
    public $routes = [];

    /**
     * Adds a new route with a specified method, path, and handler.
     * @param $method - specified HTTP method (GET, POST, etc.)
     * @param $path - the path of the webpage (/home, /about, etc.)
     * @param $handler - the corresponding function for the method and path
     * @return void
     */
    public function addRoute($method, $path, $handler)
    {
        $this->routes[$method][$path] = $handler;
    }

    /**
     * Handles the request based on the current URL
     * @return void
     */
    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = '/cs-312_boothlink';

        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        // Responds with 404 when method and path is not a set variable in the routes array
        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            call_user_func($handler);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}