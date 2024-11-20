<?php

namespace model\objects;
class Reservation
{
    private $id;
    private $customer;
    private $product;
    private $quantity;
    private $category;
    private $date;
    private $status;
    private $price;

    public function getID()
    {
        return $this->id;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getID(),
            'customer' => $this->getCustomer(),
            'product' => $this->getProduct(),
            'quantity' => $this->getQuantity(),
            'category' => $this->getCategory(),
            'date' => $this->getDate(),
            'status' => $this->getStatus(),
            'price' => $this->getPrice()
        ];
    }
}