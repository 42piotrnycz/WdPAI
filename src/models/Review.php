<?php

class Review
{
    private $title;
    private $reviewTitle;
    private $description;
    private $stars;
    private $image;

    public function __construct($title, $reviewTitle, $description, $stars, $image)
    {
        $this->title = $title;
        $this->reviewTitle = $reviewTitle;
        $this->description = $description;
        $this->stars = $stars;
        $this->image = $image;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getReviewTitle()
    {
        return $this->reviewTitle;
    }
    public function setReviewTitle($reviewTitle)
    {
        $this->reviewTitle = $reviewTitle;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getStars()
    {
        return $this->stars;
    }
    public function setStars($stars)
    {
        $this->stars = $stars;
    }



}