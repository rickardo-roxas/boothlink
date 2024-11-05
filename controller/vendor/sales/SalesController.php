<?php


if (isset($_GET['category'])) {
    $filter = $_GET['category'];
    $controller = new SalesController();
    if ($filter== 'all') {
        $controller ->index();
    } else {
        $controller->filteredCategory($filter);
    }
} else if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $controller = new SalesController();
    $controller->filteredStatus($status);
}

class SalesController {

    private $model;

    private $products;

    public function __construct() {

            include(__DIR__ . '/../../../model/vendor/sales/SalesModel.php');
            $this->model = new SalesModel();
    }

    public function getModel(): SalesModel
    {
        return $this->model;
    }

    public function index() {
        $this->products = $this->getModel()->getProducts();
        $this->initPage();

    }
    public function filteredCategory($filter) {
        $this->products = $this->model->filterCategoryUsing($filter);
        $this->initPage();
    }
    public function filteredStatus($filter) {
        $this->products = $this->model->filterStatusUsing($filter);
        $this->initPage();
    }


    public function initPage() {
        $salesToday = $this->getModel()->getSalesToday();
        $salesWeek = $this->getModel()->getSalesWeek();
        $xValues = $this->getModel()->getXValues();
        $labels = $this->getModel()->getLabels();
        header('Location: /cs-312_boothlink/view/vendor/sales/sales_view.php?productList='
            .serialize($this->products)
            . "&salesToday=" . $salesToday
            . "&salesWeek=" . $salesWeek
            . "&xValues=" . serialize($xValues)
            . "&labels=" . serialize($labels)
        );
        exit();
    }
}
