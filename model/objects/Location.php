<?php

class Location
{
    /**
     * @var - The room (D424, etc.) of the stall.
     */
    private $room;
    /**
     * @var - The assigned stall number.
     */
    private $stallNumber;

    /**
     * Constructs an object of Location with a specified room and stall number.
     * @param $room - The specified room.
     * @param $stallNumber - The specified stall number.
     */
    public function __construct($room, $stallNumber) {
        $this->room = $room;
        $this->stallNumber = $stallNumber;
    }

    /**
     * Retrieves the value of room.
     * @return mixed - the String value of room.
     */
    public function getRoom() {
        return $this->room;
    }

    /**
     * Retrieves the value of stallNumber.
     * @return mixed - The int value of stallNumber.
     */
    public function getStallNumber() {
        return $this->stallNumber;
    }

    /**
     * Sets the value of room with a specified value..
     * @param $room - The specified room.
     * @return void
     */
    public function setRoom($room) {
        $this->room = $room;
    }

    /**
     * Sets the value of stall number with a specified value.
     * @param $stallNumber - The specified stall number.
     * @return void
     */
    public function setStallNumber($stallNumber) {
        $this->stallNumber = $stallNumber;
    }
}
