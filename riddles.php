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
<body bgcolor=white>

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
try {
    $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", "username", "username", []);
    $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e){
    echo "Error connecting to mysql";
}
?>

<?php
if ($action == 'default'):
    ?>
<div class="logInWrapper">
    <div class="logInBox">
        <form method="get">
        <header style="font-family: 'PT Serif', serif; font-size: 1.6em;"> Search for a riddle by ID</header> <br>
        <label class="LogInElement">
            <input type="text" name="id" class="generalInput">
        </label>
            <br> <br>
            <input type="hidden" name="action" value="step2">
            <input name="submit" type="submit" class="logInButton">
            <br><br>
    </form>
    </div>
    </div>
</div>

    <?php
endif;
?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;
?>

<?php
if ($action == 'step2'):

    $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $rows = $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $riddleTitle = $rows[0]['title'];
    $riddleQuestion = $rows[0]['question'];
    $riddleAuthor = $rows[0]['author'];
    $riddleDate = $rows[0]['date'];
    echo "<div class=\"featRiddle\">";
    echo "<header class=\"featRiddleTitle\">";
    echo $riddleTitle;
    echo "</header>";
    echo "<p style=\"font-family: 'PT Serif', serif; font-size: .9em;\">";
    echo "Submitted by <em>" . $riddleAuthor . "</em>";
    echo "</p> <hr>";
    echo "<p class=\"featRiddleInfo\">";
    echo $riddleQuestion;
    echo "</p> </div>";

?>

<?php
else:
for($x = 1; $x < 10; $x++) {

//    $riddleName = "100 Prisoners and a Light Bulb";
//    $riddleInfo = "100 prisoners are imprisoned in solitary cells. Each cell is windowless and soundproof. There's a central living room with one light bulb; the bulb is initially off. No prisoner can see the light bulb from his or her own cell. Each day, the warden picks a prisoner equally at random, and that prisoner visits the central living room; at the end of the day the prisoner is returned to his cell. While in the living room, the prisoner can toggle the bulb if he or she wishes. Also, the prisoner has the option of asserting the claim that all 100 prisoners have been to the living room. If this assertion is false (that is, some prisoners still haven't been to the living room), all 100 prisoners will be shot for their stupidity. However, if it is indeed true, all prisoners are set free and inducted into MENSA, since the world can always use more smart people. Thus, the assertion should only be made if the prisoner is 100% certain of its validity.
//    Before this whole procedure begins, the prisoners are allowed to get together in the courtyard to discuss a plan. What is the optimal plan they can agree on, so that eventually, someone will make a correct assertion?";
    $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id = :id");
    $stmt->bindValue(":id", $x);
    $rows = $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $riddleTitle = $rows[0]['title'];
    $riddleQuestion = $rows[0]['question'];
    if (strlen($riddleQuestion) > 126){
        $riddleInfoSub = substr($riddleQuestion, 0, 126) . "...";}
    else {
        $riddleInfoSub = $riddleQuestion;
    }
    $riddleDate = $rows[0]['date'];
    $riddleAuthor = $rows[0]['author'];
    $idLine = "<input type=\"hidden\" name=\"id\" value=\"".$x."\">";
    if ($riddleTitle and $riddleQuestion and $riddleAuthor and $riddleDate) {
        echo "<form method=\"GET\">";
        echo "<button class=\"riddleDiv\">";
        echo "<span class = 'riddleName'>" . $riddleTitle . " " . "</span>";
        echo "<span class = 'riddleAuthor'>| Submitted by <em>" . $riddleAuthor . "</em> | </span>";
        echo "<span class = 'riddleDate'>" . $riddleDate . "</span><br>";
        echo "<span class = 'riddleInfo'>" . $riddleInfoSub . "</span>";
        echo $idLine;
        echo "<input type=\"hidden\" name=\"action\" value=\"step2\">";
        echo "</button>";
        echo "</form>";
    }
}
endif;
?>

</body>
</html>