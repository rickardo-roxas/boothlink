<?php

class Router {
    public function route($requestUri) {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        $page = trim($uri, '/');

        switch ($page) {
            case 'cs-312_boothlink/home':
                $this->loadPage('home');
                break;

            case 'cs-312_boothlink/reservations':
                $this->loadPage('reservations');
                break;

            case 'cs-312_boothlink/products':
                $this->loadPage('products');
                break;

            case 'cs-312_boothlink/schedule':
                $this->loadPage('schedule');
                break;

            case 'cs-312_boothlink/sales':
                $this->loadPage('sales');
                break;

            default:
                // Handle 404 Not Found
                $this->loadPage('404');
                break;
        }
    }

    private function loadPage($page) {
        $pageHandler = new PageHandler();
        $pageHandler->loadPage($page);
    }
}