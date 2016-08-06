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
    <body bgcolor=white>

    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : 'default';
    ?>

    <?php
    if ($action == 'default'):
        ?>
        <h3>Search for a riddle by id.</h3>
        <form action='riddles.php'>
            Riddle ID:<br>
            <input type="text" name="id">
            <input type="hidden" name="action" value="step2">
            <input type="submit" value="Submit">
        </form>

        <?php
    endif;
    ?>

    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    ?>

    <?php
    if ($action == 'step2'):

        try {
            # First let us connect to our database
            $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", "username", "password", []);
            $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $e){
            echo "Error connecting to mysql";
        }

        $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $rows = $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //echo '<pre>' . print_r($rows, true) . '</pre>';
        echo $rows[0]['question']."<br>";
        echo $rows[0]['answer']."<br>";
    endif;
    ?>
</html>