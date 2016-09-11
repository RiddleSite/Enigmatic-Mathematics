<?php

function navBarMake() {
    echo"
<header class='topBody'>
    <a href='index.php'>
        <div class='logo'>
            <header>Enigmatic Mathematics</header>
        </div>
    </a>
    <nav id='navBar'>
        <ul>
            <li>
                <a href='index.php' style='text-decoration: none;'>Home</a>
            </li>

            <li>
                <a href='riddles.php'>Riddles</a>
            </li>

            <li>
                <a href='signUp.php'>Sign Up</a>
            </li>

            <li>
                <a href='contact.php'>Contact</a>
            </li>
";
            if (isset($_SESSION['username'])): echo"
                <li>
                    <a href='logout.php' style='text-decoration: none;'>Log Out</a>
                </li>
            ";

            else: echo"
                <li>
                    <a href='login.php' style='text-decoration: none;'>Log In</a>
                </li>";
            endif;
echo"
</ul>
</nav>
</header>
";
}

?>