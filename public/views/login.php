<!DOCTYPE html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<body>
    <div class="base-container">
        <div class="logo">
            <img class="logo" src="public/img/logo.png" alt="Logo"></img>
        </div>
        <div class="login-container">
            <?php include 'public/templates/messages.php'; ?>

            <form class="login" action="login" method="POST">
                <input name="email" type="email" placeholder="johnsmith@gmail.com">
                <input name="password" type="password" placeholder="password">
                <button type="submit">Log In</button>

            </form>
        </div>
        <div class="buttons-container">
            <a href="register">
                <button class="redirect">Create Account</button>
            </a>
        </div>
    </div>
</body>