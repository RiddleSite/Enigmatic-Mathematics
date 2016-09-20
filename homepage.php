<?php
if (isset($_SESSION['username'])):
?>
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
<?php require 'navBar.php'; navBarMake(); ?>
<div class="welcomeMsg">
    <h1>
        Hello Again!
    </h1>
    <p>
        You are logged in as <?php echo $_SESSION['username'] ?>. Hope that's you.
    </p>

</div>
<li>
    <a href="submission.php">Submit</a>
</li>

Your submissions: <br>
<?php
$config_array = parse_ini_file("/home1/isamilefchik/public_html/privateConfig/webconfig.ini");
    try {
        $db_username = $config_array['mySQL_username'];
        $db_password = $config_array['mySQL_password'];
        $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", $db_username, $db_password, []);
        $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $e){
        echo "Error: could not connect to database";
    }
    $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE author = :username");
    $stmt->bindValue(":username", $_SESSION['username']);
$rows = $stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
$riddleTitle = $row['title'];
$riddleQuestion = $row['question'];
if (strlen($riddleQuestion) > 126) {
    $riddleInfoSub = substr($riddleQuestion, 0, 126) . "...";
} else {
    $riddleInfoSub = $riddleQuestion;
}
$dateTime = new DateTime($row['date]']);
$riddleDate = $dateTime->format("d F Y");
$riddleCategory = $row['category'];
$riddleAuthor = $row['author'];
$idLine = "<input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\">";
if ($riddleTitle and $riddleQuestion and $riddleAuthor) {
echo "<form method=\"GET\">";
echo "<button class=\"riddleDiv\">";
echo "<span class = 'riddleName'>" . $riddleTitle . " | " . "</span>";
echo "<span class = 'riddleDate'>" .  $riddleCategory . " | " . "</span>";
echo "<span class = 'riddleAuthor'> Submitted by <em>" . $riddleAuthor . "</em> | </span>";
echo "<span class = 'riddleDate'>" . $riddleDate . "</span><br>";
echo "<span class = 'riddleInfo'>" . $riddleInfoSub . "</span>";
echo $idLine;
echo "</button>";
echo "</form>";
    }
}
?>
</html>

<?php
else:
echo "Please log in to access your home page or sign up if you haven't already.";
endif;
?>
