<?php

namespace model\objects;
class Sales
{
    private $customer;
    private $reservation;

    function __construct($customer, $reservation)
    {
        $this->customer = $customer;
        $this->reservation = $reservation;
    }

    function getCustomer()
    {
        return $this->customer;
    }

    function getReservation()
    {
        return $this->reservation;
    }

    function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    function setReservation($reservation)
    {
        $this->reservation = $reservation;
    }
}
