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
    private $locationRoom;
    /**
     * @var - The related location stall number.
     */
    private $locationStallNum;

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
    public function getLocationRoom() {
        return $this->locationRoom;
    }

    public function getLocationStallNum() {
        return $this->locationStallNum;
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
    public function setLocationRoom($locationRoom) {
        $this->locationRoom = $locationRoom;
    }

    public function setLocationStallNum($locationStallNum) {
        $this->locationStallNum = $locationStallNum;
    }

    public function toArray(): array {
        return [
            'date' => $this->getDate(),
            'startTime' => $this->getStartTime(),
            'endTime' => $this->getEndTime(),
            'locationRoom' => $this->getLocationRoom(),
            'locationStallNum' => $this->getLocationStallNum()
        ];
    }
}
