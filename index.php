<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('reviews', 'DefaultController');
Routing::get('add_review', 'DefaultController');
Routing::get('addReview', 'ReviewController');
Routing::post('login', 'DefaultController');

Routing::run($path);