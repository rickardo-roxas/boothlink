<?php

class Schedule
{
    /**
     * @var - The data of the schedule (2024-10-23, etc.)
     */
    private $date;
    /**
     * @var - The start time of the schedule (10:00, etc.)
     */
    private $startTime;
    /**
     * @var - The end time of the schedule (13:00, etc.)
     */
    private $endTime;
    /**
     * @var - The related location based on the schedule.
     */
    private $location;

    /**
     * Constructs an object of Schedule with a specified date, start time, and end time.
     * @param $date - The specified date.
     * @param $startTime - The specified start time.
     * @param $endTime - The specified end time.
     * @param $location - The specified location.
     */
    public function __construct($date, $startTime, $endTime, $location)
    {
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getStartTime() {
        return $this->startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime() {
        return $this->endTime;
    }

    /**
     * @return mixed
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param $date
     * @return void
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @param $startTime
     * @return void
     */
    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    /**
     * @param $endTime
     * @return void
     */
    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }

    /**
     * @param $location
     * @return void
     */
    public function setLocation($location) {
        $this->location = $location;
    }
}
