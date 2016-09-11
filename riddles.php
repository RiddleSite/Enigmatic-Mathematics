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
<?php
require 'navBar.php'; navBarMake();
$get_date_sort = isset($_GET['newOrOld']) ? $_GET['newOrOld'] : "new";
$get_id = isset($_GET['id']) ? $_GET['id'] : false;
$get_author = isset($_GET['author']) ? $_GET['author'] : false;
$get_category = isset($_GET['category']) ? $_GET['category'] : false;
$get_category = ($get_category == "all") ? "*" : $get_category;
$get_keyword = isset($_GET['keyword']) ? $_GET['keyword'] : false;
$config_array = parse_ini_file("webconfig.ini");
function print_full_riddle($stmt)
{
    $rows = $stmt->execute();
    if ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)):
        $riddleTitle = $rows[0]['title'];
        $riddleQuestion = $rows[0]['question'];
        $riddleAuthor = $rows[0]['author'];
        $riddleCategory = $rows[0]['category'];
        $dateTime = new DateTime($rows[0]['date]']);
        $riddleDate = $dateTime->format("d F Y, g:m A");
        echo "<div class=\"featRiddle\">";
        echo "<header class=\"featRiddleTitle\">";
        echo $riddleTitle;
        echo "</header>";
        echo "<p style=\"font-family: 'PT Serif', serif; font-size: .9em;\">";
        echo $riddleCategory . " | ";
        echo "Submitted by <em>" . $riddleAuthor . "</em>  | ";
        echo "<span class = 'riddleDate'>" . $riddleDate . "</span><br>";
        echo "</p> <hr>";
        echo "<p class=\"featRiddleInfo\">";
        echo $riddleQuestion;
        echo "</p> </div>";
    else:
        echo "Resource not found";
        header("HTTP/1.0 404 Not Found");
    endif;
}
function print_riddle_previews($stmt){
    $rows = $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    print_r($rows);
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
}
try {
    $db_username = $config_array['mySQL_username'];
    $db_password = $config_array['mySQL_password'];
    $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", $db_username, $db_password, []);
    $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e){
    echo "Error: could not connect to database";
}
?>

<?php
if ($get_id === false):
    ?>

    <div class="logInWrapper">
        <div class="logInBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                <header style="font-family: 'PT Serif', serif; font-size: 1.6em;"> Search for a riddle by ID</header> <br>
                <label class="LogInElement">
                    <input type="text" name="id" class="generalInput">
                </label>
                <br> <br>
                <input type="submit" class="logInButton">
                <br><br>
                <input id="newOrOld" type="checkbox" style="display: none;" value="new">
                <select name="category" onchange="categoryChange(this);" class="categoryDropDown">
                    <option value="all" id="EasyOption">All</option>
                    <option value="easy" id="EasyOption">Easy</option>
                    <option value="medium" id="MediumOption">Medium</option>
                    <option value="hard" id="HardOption">Hard</option>
                    <option value="cs" id="csOption">CS</option>
                    <option value="logic" id="logicOption">Logic</option>
                    <option value="probability" id="probabilityOption">Probability</option>
                    <option value="math" id="MathOption">Mathematics</option>
                </select>
                <br><br>
                <div class="sortAgeButtonSelected" onclick="toggle(this, 'new')" id="selectedAge">New - Old</div>
                <div class="sortAgeButtonBlank" onclick="toggle(this, 'old')" id="nullAge">Old - New</div>
            </form>
            <!--        Now that we are sorting riddles by age and type, let's add a "filter by" button that includes all
                        of those categories in a pull down menu. I can easily add a function that can search by those
                        parameters if you supply input.
                        Also note- a keyword search is also a possibility with some of the MySQL tools. Might be worth looking into.
            -->
        </div>
    </div>

    <?php
endif;
?>

<?php
if ($get_date_sort == "new"):
    if ($get_id):
        $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id = :id ORDER BY date DESC");
        $stmt->bindValue(":id", $get_id);
        print_full_riddle($stmt);
    elseif ($get_author):
        if ($get_category):
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE author = :author AND category = :category ORDER BY date DESC");
            $stmt->bindValue(":author", $get_author);
            $stmt->bindValue(":category", $get_category);
            print_riddle_previews($stmt);
        else:
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE author = :author ORDER BY date DESC");
            $stmt->bindValue(":author", $get_author);
            print_riddle_previews($stmt);
        endif;
    elseif ($get_keyword):
        if ($get_category):
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE question LIKE :keyword AND category = :category ORDER BY date DESC");
            $stmt->bindValue(":keyword", $get_keyword);
            $stmt->bindValue(":category", $get_category);
            print_riddle_previews($stmt);
        else:
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE question LIKE :keyword ORDER BY date DESC");
            $stmt->bindValue(":keyword", $get_keyword);
            print_riddle_previews($stmt);
        endif;
    else:
        $min_id = 1;
        $max_id = 11;
        $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id >= :min_id and id <= :max_id ORDER BY date DESC");
        $stmt->bindValue(":min_id", $min_id);
        $stmt->bindValue(":max_id", $max_id);
        print_riddle_previews($stmt);
    endif;
elseif ($get_date_sort == "old"):
    if ($get_id):
        $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id = :id ORDER BY date ASC");
        $stmt->bindValue(":id", $get_id);
        print_full_riddle($stmt);
    elseif ($get_author):
        if ($get_category):
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE author = :author AND category = :category ORDER BY date ASC");
            $stmt->bindValue(":author", $get_author);
            $stmt->bindValue(":category", $get_category);
            print_riddle_previews($stmt);
        else:
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE author = :author ORDER BY date ASC");
            $stmt->bindValue(":author", $get_author);
            print_riddle_previews($stmt);
        endif;
    elseif ($get_keyword):
        if ($get_category):
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE question LIKE :keyword AND category = :category ORDER BY date ASC");
            $stmt->bindValue(":keyword", $get_keyword);
            $stmt->bindValue(":category", $get_category);
            print_riddle_previews($stmt);
        else:
            $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE question LIKE :keyword ORDER BY date ASC");
            $stmt->bindValue(":keyword", $get_keyword);
            print_riddle_previews($stmt);
        endif;
    else:
        $min_id = 1;
        $max_id = 11;
        $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id >= :min_id and id <= :max_id ORDER BY date ASC");
        $stmt->bindValue(":min_id", $min_id);
        $stmt->bindValue(":max_id", $max_id);
        print_riddle_previews($stmt);
        endif;
endif;
?>

</body>
</html>
