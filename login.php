<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="web_effects.js"></script>
    <script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>
    <script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
    <link rel="shortcut icon" href="favicon.ico" type="favicon/ico">

    <title>Enigmatic Mathematics</title>

</head>
<body>
<header class="topBody">
    <a href="index.php">
        <div class="logo">
            <header>Enigmatic Mathematics</header>
        </div>
    </a>
    <nav id="navBar">
        <ul>
            <li>
                <a href="index.php" style="text-decoration: none;">Home</a>
            </li>

            <li>
                <a>Riddles</a>
            </li>

            <li>
                <a href="login.php" style="text-decoration: none;">Log In</a>
            </li>

            <li>
                <a>Sign Up</a>
            </li>

            <li>
                <a>Contact</a>
            </li>
        </ul>
    </nav>
</header>
<div class="logInWrapper">
    <div class="logInBox">
        <header style="font-family: 'PT Serif', serif; font-size: 1.6em;"> Log In </header> <br>
        <div class="logInInfoWrap">
            <div class="LogInElement"><em>Username:</em></div>
            <div class="LogInElement">
                <input type="text" name="Username" style="width: inherit; border: solid; border-width: 2px; border-radius: 0;">
            </div>
            <br>
            <br>
            <div class="LogInElement"><em>Password:</em></div>
            <div class="LogInElement">
                <input  name="Password" type = "password" style="width: inherit; border: solid; border-width: 2px; border-radius: 0;">
            </div>
        </div> <br> <br>
        <button class="logInButton">Let me in!</button><br><br>
        <a href="userRecovery.php"><em><b>Forgot password/username?</b></em></a>
</div>

</body>