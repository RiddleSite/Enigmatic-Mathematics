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

    <title>Riddles</title>

</head>
<body>
<header class="topBody">
    <div class="logo">
        <header>Enigmatic Mathematics</header>
    </div>
    <nav id="navBar">
        <ul>
            <li>
                <a>Home</a>
            </li>

            <li>
                <a>Riddles</a>
            </li>

            <li>
                <a>Log In</a>
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

<main class="mainBody">
    <div class="welcomeMsg">
        <h1>
            Welcome!
        </h1>
        <p>
            You have arrived at
        </p>
        <p>
            $\sum \mathbb{N}\Im G^{M} \forall  \Upsilon \Phi \zeta $ $\boldsymbol{M}\partial \mathit{T} \frac{h }{\xi  }\mathfrak{M}\Lambda\Gamma \Psi \varsigma \mathfrak{s}$
        </p>
        <p>
            the first stop for math riddlers and freakoids!
        </p>
        <form action="#" method="post">
            Name: <input type="text" name="name"><br>
            <input type="submit">
            <?php
                $name = htmlspecialchars($_POST["name"]);
            ?>
    </div>
</main>
<?php
$file = fopen("/keys/Pi_SQL_Keys.txt", "r");
$line = 0;
while(! feof($file))
{
    $line++;
    if ($line == "1"){
        $username = fgets($file);
    }
    if ($line == "2"){
        $password = fgets($file);
    }
    else{
        fclose($file);
        break;
    }
}
$servername = "192.168.1.14";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$query = sprintf("SELECT * FROM riddles WHERE name=%s",
    $name);
echo $query;
?>
</body>
</html>