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
    <a href="index.php" class="navbar-logo">My Reviews</a>
    <div class="navbar-links">
        <a href="/"><button type="button">Main Page</button></a>
        <a href="/addReview"><button type="button">Add Review</button></a>
        <a href="/reviews"><button type="button">All Reviews</button></a>

    </div>
    <div>
        <?php if ($user): ?>
            <span class="navbar-user"><?= htmlspecialchars($user->getNickname()); ?></span>
            <a href="/logout" class="logout-button"><button type="button">Log Out</button></a>
        <?php endif; ?>
    </div>


</nav>
