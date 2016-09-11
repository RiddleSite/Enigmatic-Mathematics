<?php
if (isset($_SESSION['username'])){
?>
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
<?php
require 'navBar.php'; navBarMake();
    $username = $_SESSION['username'];
    echo "Welcome, " . $username . ".";
    echo "We are currently working on a submissions and control page for our users- please come back later!";
}
    else {
    echo "You are not properly credentialed to access this page.";
    header("HTTP/1.0 404 Not Found");
}
// Will have no idea if any of that works until we put it up. Consider doing a test session where the site is only
// available to us.
?>
