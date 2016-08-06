<!DOCTYPE html>
<html>
<head>
    <title>Testing MySQL Connection</title>
</head>
<body bgcolor=white>

<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'default';
?>

<?php
if ($action == 'default'):
?>
<h3>Sample side for riddle database queries.</h3>
<form action='init.php'>
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