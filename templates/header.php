<?php
session_start();


if (isset($_GET['logout'])) {

    destorySession();
}
function destorySession()
{
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    header("Location: login.php");
}
function renderUserDetails()
{
    $user = $_SESSION["email"];

    if ($user) {
        echo  "<a class='text-white ml-4'>{$user}</a> <a class='text-white ml-4' href='todo.php?logout=true'>Logout</a>";
    } else {
        echo '<a class="text-white ml-4" href="login.php">Login</a>';
    }
}

?>
<nav class="navbar bg-navbar justify-content-between p-4">
    <a class="navbar-brand text-white font-weight-bold text-uppercase"></a>
    <div>
        <a class="text-white ml-4" href="todo.php">Tasks</a>
        <?php renderUserDetails() ?>


    </div>
</nav>