<!-- connect to db -->
<?php $dbConnection = mysqli_connect("localhost", "root", "", "web-dev-todolist");
if (!$dbConnection) {
    echo 'Database connection error ' . mysqli_connect_error();
}


function fetchTodos($dbConnection)
{

    $todos = mysqli_query($dbConnection, "SELECT * FROM `todos` ORDER BY id DESC;");
    if (mysqli_num_rows($todos) > 0) {
        while ($row = mysqli_fetch_assoc($todos)) {

            echo "
            <div class='tasks content  mb-4 todo-card'>
            <input type='text' class='text' name='task' value='{$row["name"]}' readonly />
            <input type='text' class='text' name='id' hidden value='{$row["id"]}' />
            <div class='actions'>
            <a href='todo.php?edit=true&id={$row["id"]}'><button class='Edit btn'>Edit</button></a>&nbsp;
            <a href='todo.php?delete=true&id={$row["id"]}'><button class='Delete btn'>Delete</button></a>&nbsp;
        </div>
        </div>

            ";
        }
    } else {
        echo '<li>no existing todos</li>';
    }

    mysqli_close($dbConnection);
}


function deleteTodo($dbConnection, $id)
{

    if (mysqli_query($dbConnection, "DELETE FROM `todos` WHERE `todos`.`id` = '$id';")) {
    } else {
        echo mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
    header("Location: todo.php");
}
function createUser($dbConnection, $name, $password)
{

    $user = mysqli_query($dbConnection, "INSERT INTO `users` (`ID`, `email`, `password`, `role`) VALUES (NULL, $name, $password, '1');");

    mysqli_close($dbConnection);
}

function createTodo($dbConnection, $taskName)
{

    if (mysqli_query($dbConnection, "INSERT INTO `todos` (`name`, `id`, `user`) VALUES ('$taskName', NULL, '1');")) {
    } else {
        echo mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
    header("Location: todo.php");
}
