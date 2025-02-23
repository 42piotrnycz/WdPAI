<!DOCTYPE html>

<head>
    <title>Creating account...</title>
    <link rel="stylesheet" type="text/css" href="public/css/login.css">

</head>

<body>
<?php include 'public/templates/navbar.php'; ?>

<div class="base-container">
    <div class="logo">
        <img class="logo" src="public/img/logo.png" alt="Logo"></img>
    </div>
    <div class="login-container">
        <?php include 'public/templates/messages.php'; ?>
        <form class="login" action="register" method="POST">
            <input name="email" type="email" placeholder="johnsmith@gmail.com" required>
            <input name="nickname" type="text" placeholder="nickname" required>
            <input name="name" type="text" placeholder="name" required>
            <input name="surname" type="text" placeholder="surname" required>
            <input name="password" type="password" placeholder="password" required>
            <div class="login-buttons">
                <button type="submit">Create Account</button>
            </div>
        </form>
    </div>
    <div class="buttons-container">
        <a href="login">
            <button class="redirect">Log In</button>
        </a>
    </div>
</div>
</body>
