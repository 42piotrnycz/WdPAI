<!DOCTYPE html>

<head>
    <title>REGISTER</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<body>
<div class="base-container">
    <div class="logo">

    </div>
    <div class="login-container">
        <?php include 'public/templates/messages.php'; ?>
        <form action="register" method="POST">
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
