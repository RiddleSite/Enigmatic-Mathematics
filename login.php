<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="web_effects.js" type="text/javascript"></script>
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
                <a href="signUp.php">Sign Up</a>
            </li>

            <li>
                <a href="contact.php">Contact</a>
            </li>
            <?php
            if (isset($_SESSION['username'])):
                ?>
                <li>
                    <a href="logout.php" style="text-decoration: none;">Log Out</a>
                </li>
                <?php
            else:
                ?>
                <li>
                    <a href="login.php" style="text-decoration: none;">Log In</a>
                </li>
                <?php
            endif;
            ?>

        </ul>
    </nav>
</header>

<?php
if (isset($_GET['submit'])):
    $config_array = parse_ini_file("webconfig.ini");
    $username = isset($_POST['Username']) ? $_POST['Username'] : 0;
    $password = isset($_POST['Password']) ? $_POST['Password'] : 0;
    if ($password and $username):
        try {
            $db_username = $config_array['mySQL_username'];
            $db_password = $config_array['mySQL_password'];
            $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", $db_username, $db_password, []);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (PDOException $e) {
            echo "Error connecting to mysql";

        }
        $stmt = $db->prepare("SELECT password FROM USERS WHERE username = :username");
        $stmt->bindValue(":username", $username);
        $response = $stmt->execute();
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (password_verify($password, $response[0]['password'])):
            session_start();
            $_SESSION['username'] = $username;
            header("Location: homepage.php");
        else:
            echo 'Incorrect username/password.';
        endif;
    else:
        echo "Please enter a valid username/password";
    endif;
    else:
?>
<div class="logInWrapper">
    <div class="logInBox">
        <header style="font-family: 'PT Serif', serif; font-size: 1.6em;"> Log In </header> <br>
        <div class="logInInfoWrap">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="LogInElement">
                <em>Username:</em>
            </div>
            <label class="LogInElement">
                <input type="text" name="Username" class="generalInput">
            </label>
            <br> <br>
            <div class="LogInElement">
                <em>Password:</em>
            </div>
            <label class="LogInElement">
                    <input type="password" name="Password" class="generalInput">
            </label>
            <br> <br>
            <input name="submit" value="Let me in!" type="submit" class="logInButton">
        <br><br>
        </form>
        </div>

        <a href="userRecovery.php"><em><b>Forgot password/username?</b></em></a>
</div>

</body>

<?php
endif;
?>
