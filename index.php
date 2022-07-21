<?php
require_once 'utils.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist - HomePage</title>
</head>

<body>
    <?php include("./templates/header.php"); ?>
    <ol>
        <?php fetchTodos($dbConnection); ?>
    </ol>

    <?php include("./templates/footer.php"); ?>


</body>

</html>