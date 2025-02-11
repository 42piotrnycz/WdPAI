<?php
require_once 'src/repository/UserRepository.php';

$userRepo = new UserRepository();
$user = null;

if (isset($_SESSION['userID'])) {
    $user = $userRepo->getUserByID($_SESSION['userID']);
}
?>

<head>
    <link rel="stylesheet" href="public/css/navbar.css">
</head>

<nav class="navbar">
    <!-- Left Section -->
    <div class="navbar-left">
        <a href="/" class="navbar-logo"><h2>REviewer</h2></a>
    </div>

    <!-- Middle Section -->
    <div class="navbar-buttons">
        <a href="/latestReviews"><button type="button">Latest Reviews</button></a>
        <?php if (isset($_SESSION['userID'])):?>
            <a href="/reviews"><button type="button">Your Reviews</button></a>
            <a href="/addReview"><button type="button">Add Review</button></a>
        <?php endif;?>

        <?php if ($user && $user->getIsAdmin()): ?>
            <a href="/moderate"><button type="button">Moderation</button></a>
        <?php endif; ?>
    </div>

    <!-- Right Section -->
    <div class="navbar-right">
        <?php if ($user): ?>
            <span class="navbar-user">
                <?php if ($user->getIsAdmin()): ?>
                    <strong>ADMIN: </strong>
                <?php endif; ?>
                <?= htmlspecialchars($user->getNickname()); ?>
            </span>
            <a href="/logout"><button type="button">Log Out</button></a>
        <?php else: ?>
            <a href="/login"><button type="button">Login</button></a>
            <a href="/register"><button type="button">Sign Up</button></a>
        <?php endif; ?>
    </div>
</nav>
