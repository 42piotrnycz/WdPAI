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
    <a href="/">REviewer</a>

    <div class="navbar-links">
        <a href="/addReview"><button type="button">Add Review</button></a>
        <a href="/reviews"><button type="button">All Reviews</button></a>

        <?php if ($user && $user->getIsAdmin()): ?>
            <a href="/moderate"><button type="button" class="admin-button">Moderation</button></a>
        <?php endif; ?>
    </div>

    <div>
        <?php if ($user): ?>
            <span class="navbar-user">
                <?php if ($user->getIsAdmin()): ?>
                    <strong>ADMIN: </strong>
                <?php endif; ?>
                <?= htmlspecialchars($user->getNickname()); ?>
            </span>
            <a href="/logout" class="logout-button"><button type="button">Log Out</button></a>
        <?php else: ?>
            <a href="/login" class="login-button"><button type="button">Login</button></a>
            <a href="/register" class="register-button"><button type="button">Sign Up</button></a>
        <?php endif; ?>
    </div>
</nav>
