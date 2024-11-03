<?php

class Reservation {
    private $customer;
    private $product;
    private $quantity;
    private $date;
    private $status;

    public function __construct($customer, $product, $quantity, $date, $status) {
        $this->customer = $customer;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->date = $date;
        $this->status = $status;
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setCustomer($customer) {
        $this->customer = $customer;
    }

    public function setProduct($product) {
        $this->product = $product;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}