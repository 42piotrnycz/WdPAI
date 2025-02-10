<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

ini_set('display_errors', 1);
error_reporting(E_ALL);

Routing::get('', 'DefaultController');

Routing::get('login', 'SecurityController');
Routing::post('login', 'SecurityController');

Routing::get('logout', 'SecurityController');
Routing::get('register', 'DefaultController');
Routing::post('register', 'SecurityController');

Routing::get('reviews', 'ReviewController');
Routing::get('review', 'ReviewController');

Routing::get('addReview', 'ReviewController');

Routing::get('editReviewPage', 'ReviewController');
Routing::post('editReview', 'ReviewController');

Routing::post('deleteReview', 'ReviewController');

Routing::run($path);
?>