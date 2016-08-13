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
                <a href="riddles.php">Riddles</a>
            </li>

            <li>
                <a href="login.php" style="text-decoration: none;">Log In</a>
            </li>

            <li>
                <a href="signUp.php">Sign Up</a>
            </li>

            <li>
                <a href="contact.php">Contact</a>
            </li>
        </ul>
    </nav>
</header>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'default';
?>

<?php
if ($action == 'default'):
?>
<div class="logInWrapper">
    <div class="logInBox">
        <header style="font-family: 'PT Serif', serif; font-size: 1.6em;"> Log In </header> <br>
        <div class="logInInfoWrap">
            <form action='login.php'>
            <div class="LogInElement"><em>Username:</em></div>
            <label class="LogInElement">
                <input type="text" name="Username" class="generalInput">
            </label>
            <br>
            <br>
            <div class="LogInElement"><em>Password:</em></div>
            <label class="LogInElement">
                    <input type="password" name="Password" class="generalInput">
            </label>
        </div>
         <br> <br>
        <input type="hidden" name="action" value="step2">
        <button class="logInButton">Let me in!</button><br><br> </form>

        <a href="userRecovery.php"><em><b>Forgot password/username?</b></em></a>
</div>

    <?php
    endif;
    ?>

    <?php
    if ($action == 'step2'):
        $username = isset($_GET['Username']) ? $_GET['Username'] : 0;
        $password = isset($_GET['Password']) ? $_GET['Password'] : 0;
        if ($password and $username):
            $password = md5($password);
            try {
                $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", "username", "password", []);
                $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch(PDOException $e){
                echo "Error connecting to mysql";

            }
            $stmt = $db->prepare("SELECT password FROM USERS WHERE username = :username");
            $stmt->bindValue(":username", $username);
            $response = $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($password == $response[0]['password']):
                echo 'Login successful. Do something here.';
            else:
                echo 'Incorrect username/password.';
            endif;
        else:
            echo "Please enter a valid username/password";
        endif;
    endif;
    ?>


</body>