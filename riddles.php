<?php
session_start(); 
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
<?php
require 'navBar.php'; navBarMake();
$get_date_sort = isset($_GET['newOrOld']) ? $_GET['newOrOld'] : "new";
$get_id = isset($_GET['id']) ? $_GET['id'] : false;
$get_author = isset($_GET['author']) ? $_GET['author'] : false;
$get_category = isset($_GET['category']) ? $_GET['category'] : false;
$get_category = ($get_category == "AllOption") ? "*" : $get_category;
$config_array = parse_ini_file("/home1/isamilefchik/public_html/privateConfig/webconfig.ini");
function print_full_riddle($stmt)
{
    $rows = $stmt->execute();
    if ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)):
        $riddleTitle = $rows[0]['title'];
        $riddleQuestion = nl2br($rows[0]['question']);
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
        echo "</p>";
        if ($_SESSION["username"] == $riddleAuthor):
            ?>
            <br>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input name="action" value="Edit" type="submit" class="logInButton">
                <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
            </form>
            <br>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input name="action" value="Delete" type="submit" class="logInButton">
                <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
            </form>
            <?php
        endif;
        echo "</div>";
    else:
        echo "Resource not found";
    endif;
}
function print_riddle_previews($stmt){
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
}
try {
    $db_username = $config_array['mySQL_username'];
    $db_password = $config_array['mySQL_password'];
    $db = new PDO("mysql:host=localhost;dbname=isamilef_EnigmaticMathematics;charset=utf8", $db_username, $db_password, []);
    $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e){
    echo "Error: could not connect to database";
}
?>
<?php
if ($_POST["action"] == "Edit") {
    $id = $_POST["id"];
    $stmt = $db->prepare("SELECT * FROM RIDDLES WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $rows = $stmt->execute();
    if ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        $riddleTitle = $rows[0]['title'];
        $riddleQuestion = $rows[0]['question'];
        $riddleAuthor = $rows[0]['author'];
        $riddleCategory = $rows[0]['category'];
        $dateTime = new DateTime($rows[0]['date']);
        $riddleDate = $dateTime->format("d F Y, g:m A");
    }
    if ($_SESSION["username"] == $riddleAuthor) {
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="submissionsBox">
                <table>
                    <header style="font-family: 'PT Serif', serif; font-size: 30px; padding-bottom: 1em;">Submit a
                        Riddle
                    </header>
                    <form class="submissionsForm">

                        <label class="submissionsLabel"> <em> Title: </em> </label> <br> <br>
                        <input id="title" name="title" class="submissionsInput" style="height: 1.5em;"
                               value="<?php echo $riddleTitle ?>" oninput="checkComplete(id)"> <br> <br>

                        <label class="submissionsLabel"> <em> Question: </em> </label> <br> <br>
                        <textarea id="question" name="question" class="submissionsInput" style="height: 20em;"
                                  oninput="checkComplete(id)"><?php echo $riddleQuestion ?></textarea> <br> <br>


                        <label id="category" name="category" class="submissionsLabel"
                               value="<?php echo $riddleCategory ?>"> <em> Category: </em> </label>
                        <select name="category" onchange="countryChanged(this);" class="submissionsInput"
        			style="float: right; width: 136px; background-color: white;" selected="math">
	    <option <?php if ($riddleCategory == "easy") echo "selected=\"selected\"" ?> value="easy" id="EasyOption">Easy</option>
	    <option <?php if ($riddleCategory == "medium") echo "selected=\"selected\"" ?> value="medium" id="MediumOption">Medium</option>
	    <option <?php if ($riddleCategory == "hard") echo "selected=\"selected\"" ?> value="hard" id="HardOption">Hard</option>
	    <option <?php if ($riddleCategory == "cs") echo "selected=\"selected\"" ?> value="cs" id="csOption">CS</option>
	    <option <?php if ($riddleCategory == "logic") echo "selected=\"selected\"" ?> value="logic" id="logicOption">Logic</option>
	    <option <?php if ($riddleCategory == "probability") echo "selected=\"selected\"" ?> value="probability" id="probabilityOption">Probability</option>
	    <option <?php if ($riddleCategory == "math") echo "selected=\"selected\"" ?> value="math" id="MathOption">Mathematics</option>
	</select>
                    </form>
        </form>
        </form> <br>
        </table>
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button id="submit" class="logInButton">Submit</button>
        </div>
        <script>
            var check_complete = {"title": 1, "question": 1}
            function checkSubmit() {
                var submitBtn = document.getElementById("submit");
                var button = 1;
                for (var element in check_complete) {
                    if (!check_complete[element]) {
                        button = 0;
                    }
                }
                if (button) {
                    submitBtn.disabled = false;
                }
                else {
                    submitBtn.disabled = true;
                }
            }
            function checkComplete(id) {
                var name = document.getElementById(id);
                if (!name.value) {
                    check_complete[id] = 0;
                }
                else {
                    check_complete[id] = 1;
                }
                checkSubmit();
            }
        </script>
        <?php
    }
    else {
        echo "You do not have permission to edit this riddle.";
        exit();
    }
    exit();
}
if ($_POST["action"] == 'update'):
    $config_array = parse_ini_file("/home1/isamilefchik/public_html/privateConfig/webconfig.ini");
        foreach ($_POST as $key => $value) {
            if (!$value):
                echo "Please enter something into all fields.";
                exit();
            endif;
        }
        try {
            $db_username = $config_array['mySQL_username'];
            $db_password = $config_array['mySQL_password'];
            $db = new PDO("mysql:host=localhost;dbname=isamilef_EnigmaticMathematics;charset=utf8", $db_username, $db_password, []);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo "Error: could not connect to database";
        }
        $stmt = $db->prepare("UPDATE RIDDLES SET question=:question, title=:title, category=:category WHERE id=:id");
        $stmt->bindValue(":id", $_POST['id']);
        $stmt->bindValue(":question", $_POST['question']);
        $stmt->bindValue(":title", $_POST['title']);
        $stmt->bindValue(":category", $_POST['category']);
        if ($response = $stmt->execute()) {
        } else {
            echo "Internal error- please try again later.";
        }
endif;
?>

<?php
if ($_POST["action"] == "Delete"):
    $config_array = parse_ini_file("/home1/isamilefchik/public_html/privateConfig/webconfig.ini");
	try {
	    $db_username = $config_array['mySQL_username'];
	    $db_password = $config_array['mySQL_password'];
	    $db = new PDO("mysql:host=localhost;dbname=isamilef_EnigmaticMathematics;charset=utf8", $db_username, $db_password, []);
	    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo "Error: could not connect to database";
        }
        $stmt = $db->prepare("DELETE FROM RIDDLES WHERE id=:id");
        $stmt->bindValue(":id", $_POST['id']);
        if ($response = $stmt->execute()) {
        } else {
            echo "Internal error- please try again later.";
        }
endif;
?>


<?php
if ($get_id === false):
    ?>

    <div class="logInWrapper">
        <div class="logInBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                <header style="font-family: 'PT Serif', serif; font-size: 1.6em;"> Search for a riddle</header> <br>
                <label>
                    <input id="searchyInput" type="text" name="id" class="searchInput">
                    <select class="searchDropDown" onchange="changeInputName(this)">
		    	<option value="ID" id="id">ID</option>
                        <option value="Author" id="author">Author</option>
                    </select>
                </label>
                <br><br>
                <select name="category" onchange="categoryChange(this);" class="categoryDropDown">
                     <option value="" id="">None</option>
                    <option value="easy" id="EasyOption">Easy</option>
                    <option value="medium" id="MediumOption">Medium</option>
                    <option value="hard" id="HardOption">Hard</option>
                    <option value="cs" id="csOption">CS</option>
                    <option value="logic" id="logicOption">Logic</option>
                    <option value="probability" id="probabilityOption">Probability</option>
                    <option value="math" id="MathOption">Mathematics</option>
                </select>
                <br> <br>
                <input type="submit" class="logInButton">
            </form>
        </div>
    </div>

    <?php
endif;
?>

<?php
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
?>

</body>
</html>
