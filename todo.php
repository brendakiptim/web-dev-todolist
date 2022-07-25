<?php
require_once 'utils.php';
session_start();


if ($_SESSION["email"]) {
    if (isset($_POST["submit"])) {

        $taskName =  htmlspecialchars($_POST["task"]);
        createTodo($dbConnection, $taskName);
    }

    if (isset($_GET['delete']) && isset($_GET['id'])) {
        $id = mysqli_real_escape_string($dbConnection, $_GET["id"]);
        // echo "<script type='text/javascript'>confirm('Are you sure you want to delete?')</script>";
        echo $id;
        deleteTodo($dbConnection, $id);
    }

    if (isset($_GET['completed']) && isset($_GET['id'])) {
        $id = mysqli_real_escape_string($dbConnection, $_GET["id"]);
        echo $id;
        completeTodo($dbConnection, $id);
    }

    if (isset($_GET['undoComplete']) && isset($_GET['id'])) {
        $id = mysqli_real_escape_string($dbConnection, $_GET["id"]);
        echo $id;
        undoCompleteTodo($dbConnection, $id);
    }
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>DBIT STUDENT TO DO LIST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/base.css" />

</head>

<body>
    <?php include("./templates/header.php"); ?>
    <header>
        <br />
        <h1>DBIT STUDENT TO DO LIST</h1>
        <br />
        <form id="new-task-form" action="todo.php" method="post">
            <input type="text" name="task" id="new-task-input" placeholder="What do you have planned?" required width="70%" />
            <div class="d-flex justify-content-center align-items-center ml-2">
                <input type="submit" name="submit" id="new-task-submit" value="ADD NEW TASK" />

                <ion-icon name="add-circle-outline" class="add-icon"></ion-icon>

            </div>

        </form>
        <div class="text-white">
            <?php include("./templates/viewTodos.php") ?>
        </div>
    </header>


</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>