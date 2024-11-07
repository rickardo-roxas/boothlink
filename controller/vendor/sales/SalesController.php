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
    private $org_id;

    public function __construct() {

            include(__DIR__ . '/../../../model/vendor/sales/SalesModel.php');
            $this->model = new SalesModel();
            $this->org_id = $_SESSION['org_id'];
    }

    public function getModel(): SalesModel
    {
        return $this->model;
    }

    public function index() {
        $this->products = $this->getModel()->getProducts($this->org_id);
        $this->initPage();

    }
    public function filteredCategory($filter) {
        $this->org_id = $_SESSION['org_id'];
        $this->products = $this->model->filterCategoryUsing($this->org_id, $filter);
        $this->initPage();
    }
    public function filteredStatus($filter) {
        $this->org_id = $_SESSION['org_id'];
        $this->products = $this->model->filterStatusUsing($this->org_id, $filter);
        $this->initPage();
    }


    public function initPage() : void{
        $salesToday = $this->getModel()->getSalesToday($this->org_id);
        $salesWeek = $this->getModel()->getSalesWeek($this->org_id);
        $array = $this->getModel() ->definePoints($this->org_id);
        $xValues = $this->getModel()->getXValues();
        $labels = $this->getModel()->getLabels();
        $productList = $this->products;

        require_once 'view/vendor/sales/sales_view.php';
        /*
        header('Location: /cs-312_boothlink/view/vendor/sales/sales_view.php?productList='
            .serialize($this->products)
            . "&salesToday=" . $salesToday
            . "&salesWeek=" . $salesWeek
            . "&xValues=" . serialize($xValues)
            . "&labels=" . serialize($labels)
            . "&array=" . serialize($array)
        );
        */
        exit();
    }
}
