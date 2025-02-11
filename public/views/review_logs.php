<?php
require_once 'src/repository/LogsRepository.php';
require_once 'src/repository/UserRepository.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userID'])) {
    header("Location: /login");
    exit();
}

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
} else {
    header("Location: /");
    exit();
}

$reviewLogsRepo = new LogsRepository();

$logs = $reviewLogsRepo->getReviewLogsByUserID($userID);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Logs of User</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/review_logs.css">
    <link rel="stylesheet" href="public/css/moderation.css">
</head>
<body>
<?php include 'public/templates/navbar.php'; ?>

<h1>Review Logs of User ID: <?= htmlspecialchars($userID) ?></h1>

<table class="logs-table">
    <thead>
    <tr>
        <th>Log ID</th>
        <th>Review ID</th>
        <th>Operation Name</th>
        <th>Operation Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= htmlspecialchars($log['reviewLogID']); ?></td>
            <td><?= htmlspecialchars($log['reviewID']); ?></td>
            <td><?= htmlspecialchars($log['operationName']); ?></td>
            <td><?= htmlspecialchars($log['operationDate']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
