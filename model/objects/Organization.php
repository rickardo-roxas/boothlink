<?php

class Organization {
    private $name;
    private $image;
    private $fbLink;
    private $xLink;
    private $igLink;

    public function __construct($name, $image, $fbLink, $xLink, $igLink) {
        $this->name = $name;
        $this->image = $image;
        $this->fbLink = $fbLink;
        $this->xLink = $xLink;
        $this->igLink = $igLink;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getFbLink() {
        return $this->fbLink;
    }

    public function getXLink() {
        return $this->xLink;
    }

    public function getIgLink() {
        return $this->igLink;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setFbLink($fbLink) {
        $this->fbLink = $fbLink;
    }

    public function setXLink($xLink) {
        $this->xLink = $xLink;
    }

    public function setIgLink($igLink) {
        $this->igLink = $igLink;
    }
}