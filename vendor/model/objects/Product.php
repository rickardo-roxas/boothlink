<?php

namespace model\objects;
class Product
{

    private $images = array();
    private $name;
    private $price;
    private $category;
    private $sold;
    private $status;

    public function __construct($images, $name, $price, $category, $sold, $status)
    {
        $this->images = $images;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->sold = $sold;
        $this->status = $status;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getSold()
    {
        return $this->sold;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function __toString()
    {
        return $this->name;
    }
}