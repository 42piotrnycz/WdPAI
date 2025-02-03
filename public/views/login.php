<!DOCTYPE html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<body>
    <div class="container">
        <div class="logo">

        </div>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="email" placeholder="johnsmith@gmail.com">
                <input name="password" type="password" placeholder="password">
                <button type="submit">Log In</button>

            </form>
        </div>
        <div class="buttons-container">
            <button class="redirect">Create Account</button>
        </div>
    </div>
</body>