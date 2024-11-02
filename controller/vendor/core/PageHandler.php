<?php

/**
 * Handles the rendition of pages.
 */
class PageHandler
{
    /**
     * Renders the view of a given webpage passed from the Router.
     * @param $path - The path passed from the Router.
     * @return void
     */
    public function render($path) {
        $view = __DIR__ . '/../../../view/vendor/' . $path . '/'.  $path . '_view' . '.php';
        if (file_exists($view)) {
            include $view;
        } else {
            http_response_code(404);
            echo "404 Not Found.";
        }
    }
}