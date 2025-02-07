<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Review.php';

class DefaultController extends AppController {
    public function index() {
        die("INDEX");
    }

    public function add_review() {
        $this->render('add_review');
    }

    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function reviews() {
        $this->render('reviews');
    }
}
