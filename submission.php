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
// temporarily necessary to add a credential in order to access this page- should be fixed soon.
$_SESSION['username'] = 'nwenger';
if (isset($_SESSION['username'])):
    $username = $_SESSION['username'];
    $action = isset($_POST['action']) ? $_POST['action'] : 'default';

    if ($action == 'default'):
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="signUpBox">
            <table>
                <header style="font-family: 'PT Serif', serif; font-size: 1.3em; padding-bottom: 1em;">Submit a Riddle</header>
                <form class="signUpForm">

                    <label class="signUpLabel"> <em> Title: </em> </label>
                    <input name="title" class="signUpFormInput" style="float: right;"> <br> <br>

                    <label class="signUpLabel"> <em> Question: </em> </label>
                    <input name="question" class="signUpFormInput" style="float: right;"> <br> <br>


                    <label name="category" class="signUpLabel"> <em> Category: </em> </label>
                    <select name="country" onchange="countryChanged(this);" class="signUpFormInput" id="countrySelect" style="float: right; width: 136px; background-color: white;">
                        <option value="easy" id="EasyOption">Easy</option>
                        <option value="medium" id="MediumOption">Medium</option>
                        <option value="hard" id="HardOption">Hard</option>
                        <option value="cs" id="csOption">CS</option>
                        <option value="logic" id="logicOption">Logic</option>
                        <option value="probability" id="probabilityOption">Probability</option>
                        <option value="math" id="MathOption">Mathematics</option>
                    </select>
                    <br>
                    <div class="captchaWrap">
                        <div class="g-recaptcha" data-sitekey="6LfiCCgTAAAAABEDZkMlZWW4pBGnj-IeeH5YH0Jf"></div>
                    </div>
                </form>
    </form>
    </form> <br>
    </table>
    <input type="hidden" name="action" value="step2">
    <button class="logInButton">Submit</button>
    </div>

    <?php
endif;
?>

<?php
if ($action == 'step2'):
    $config_array = parse_ini_file(".webconfig");
    $captcha_response = $_POST['g-recaptcha-response'];
    $google_secret = $config_array['google_secret'];
    $remote_ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$google_secret."&response=".$captcha_response."&remoteip=".$remote_ip);
    $responseKeys = json_decode($response,true);
    if(intval($responseKeys["success"]) !== 1) {
        foreach ($_POST as $key => $value) {
            if (!$value):
                echo "Please enter something into all fields.";
                break;
            endif;
        }
            try {
                $db_username = $config_array['mySQL_username'];
                $db_password = $config_array['mySQL_password'];
                $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", $db_username, $db_password, []);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                echo "Error: could not connect to database";
            }
            $stmt = $db->prepare("INSERT INTO RIDDLES (question, date, title, author, category) VALUES (:question, :date, :title, :author, :category)");
            $stmt->bindValue(":question", $_POST['question']);
            $stmt->bindValue(":date", date("Y-m-d H:i:s"));
            $stmt->bindValue(":title", $_POST['title']);
            $stmt->bindValue(":author", $username);
            $stmt->bindValue(":category", $_POST['category']);
                if ($response = $stmt->execute()) {
                    echo "Riddle successfully added";
                } else {
                    echo "Internal error- please try again later.";
                }
    }
    else{
        echo "Error- possibility of spam detected.";
    }
    ?>

    <?php
endif;
else:
    echo "Please sign in to submit a riddle";
endif;
?>

</body>
