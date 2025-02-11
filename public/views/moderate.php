<!DOCTYPE html>
<html>
<head>
    <title>Moderation Panel</title>

    <link rel="stylesheet" href="public/css/moderation.css">
</head>
<body>
<?php include 'public/templates/navbar.php'; ?>

<h1 style="color:white">Moderation panel:</h1>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="error-message">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Nickname</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Admin</th>
        <th>Akcja</th>
    </tr>
    <div class="user-list">
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user->getUserID()); ?></td>
                <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
                <td><?php echo htmlspecialchars($user->getNickname()); ?></td>
                <td><?php echo htmlspecialchars($user->getName()); ?></td>
                <td><?php echo htmlspecialchars($user->getSurname()); ?></td>
                <td><?php echo $user->getIsAdmin() ? 'Admin' : 'User'; ?></td>
                <td>
                    <div class="admin-panel-grid">
                        <a href="reviewLogs?userID=<?php echo $user->getUserID(); ?>" ><button class="view-logs-button">REVIEW LOGS</button></a>

                        <?php if ($user->getUserID() != $_SESSION['userID']):?>
                        <form method="POST" action="moderate" style="display:inline;">
                            <button type="submit" name="delete" value="<?php echo $user->getUserID(); ?>" class="role-change-button" onclick="return confirm('Are you sure you want to delete this user?');">DELETE</button>
                        </form>

                        <form method="GET" action="moderate" style="display:inline;">
                            <button type="submit" name="changeRole" value="<?php echo $user->getUserID(); ?>" class="role-change-button">
                                <?php echo $user->getIsAdmin() ? 'CHANGE ROLE TO USER' : 'CHANGE ROLE TO ADMIN'; ?>
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </div>
</table>

</body>
</html>
