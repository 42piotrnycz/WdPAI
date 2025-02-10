<?php

class Review
{
    private $reviewID;
    private $userID;
    private $title;
    private $reviewTitle;
    private $description;
    private $stars;
    private $image;

    public function __construct($userID, $title, $reviewTitle, $description, $stars, $image, $reviewID = null)
    {
        $this->userID = $userID;
        $this->title = $title;
        $this->reviewTitle = $reviewTitle;
        $this->description = $description;
        $this->stars = $stars;
        $this->image = $image;
        $this->reviewID = $reviewID;
    }

    public function getReviewID()
    {
        return $this->reviewID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function setReviewID($reviewID)
    {
        $this->reviewID = $reviewID;  // Poprawione: dodano znak $ przed reviewID
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
