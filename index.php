<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <?php
            if(isset($_SESSION['userid'])) { ?>
            <li><a href="#" class="signed-in"><?php echo $_SESSION['useruid'] ?></a></li>
            <li><a href="includes/logout.inc.php" class="header-logout">LOGOUT</a></li>
            <?php } else { ?>
            <li><a href="#" class="header-signup">Sign Up</a></li>
            <li><a href="#" class="header-login">Login</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>

<section>
    <div class="wrapper">
        <div class="signup">
            <h4>Sign Up</h4>
            <p>Don't have an account? Sign up here!</p>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username">
                <br>
                <input type="password" name="password" placeholder="Password">
                <br>
                <input type="password" name="passwordRepeat" placeholder="Repeat Password">
                <br>
                <input type="text" name="email" placeholder="E-mail">
                <br>
                <button type="submit" name="submit" class="signup-btn">Sign Up</button>
            </form>
        </div>
        <div class="login">
            <h4>Login</h4>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <br>
                <button type="submit" name="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
</section>

</body>
</html>