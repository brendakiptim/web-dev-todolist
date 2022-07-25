<!-- connect to db -->
<?php $dbConnection = mysqli_connect("localhost", "root", "", "web-dev-todolist");
if (!$dbConnection) {
    echo 'Database connection error ' . mysqli_connect_error();
}


function fetchTodos($dbConnection)
{
    $user = $_SESSION["userId"];
    $todos = mysqli_query($dbConnection, "SELECT * FROM `todos` WHERE isCompleted = 0 AND user =$user  order by(id) DESC;");
    if (mysqli_num_rows($todos) > 0) {

        while ($row = mysqli_fetch_assoc($todos)) {
            $hide = $row['isCompleted'] == "1" ?  'completed-task bg-success' : '';
            $actions = $row['isCompleted'] == "0" ?  "
            <a href='todo.php?edit=true&id={$row["id"]}'><ion-icon class='text-white' name='create'></ion-icon></a>&nbsp;
            <a href='todo.php?completed={$row["isCompleted"]}&id={$row["id"]}'><ion-icon class='text-success'  name='checkmark-done'></ion-icon></a>&nbsp;
           
            <a href='todo.php?delete=true&id={$row["id"]}'><ion-icon class='text-danger' name='trash-bin'></ion-icon></a>&nbsp;
            " : "
           
           
            <a href='todo.php?undoComplete={$row["isCompleted"]}&id={$row["id"]}'><ion-icon class='text-white'  name='refresh'></ion-icon></a>&nbsp;
            <a href='todo.php?delete=true&id={$row["id"]}'><ion-icon class='text-danger' name='trash-bin'></ion-icon></a>&nbsp;
            ";


            echo "
            <div class='tasks content  mb-4 todo-card d-flex justify-content-between {$hide}'>
            <input type='textarea' class='text' name='task' value='{$row["name"]}' readonly />
            <input type='text' class='text' name='id' hidden value='{$row["id"]}' />
            <div class='actions d-flex justify-content-between align-items-center'>
           {$actions}</div>
        </div>

            ";
        }
    } else {
        echo '<li>no existing todos</li>';
    }

    // mysqli_close($dbConnection);
}



function fetchCompletedTodos($dbConnection)
{
    $user = $_SESSION["userId"];

    $todos = mysqli_query($dbConnection, "SELECT * FROM `todos` WHERE isCompleted = 1 AND user =$user order by(id) DESC;");
    if (mysqli_num_rows($todos) > 0) {

        while ($row = mysqli_fetch_assoc($todos)) {
            $hide = $row['isCompleted'] == "1" ?  'completed-task bg-success' : '';
            $actions = $row['isCompleted'] == "0" ?  "
            <a href='todo.php?edit=true&id={$row["id"]}'><ion-icon class='text-white' name='create'></ion-icon></a>&nbsp;
            <a href='todo.php?completed={$row["isCompleted"]}&id={$row["id"]}'><ion-icon class='text-success'  name='checkmark-done'></ion-icon></a>&nbsp;
           
            <a href='todo.php?delete=true&id={$row["id"]}'><ion-icon class='text-danger' name='trash-bin'></ion-icon></a>&nbsp;
            " : "
           
           
            <a href='todo.php?undoComplete={$row["isCompleted"]}&id={$row["id"]}'><ion-icon class='text-white'  name='refresh'></ion-icon></a>&nbsp;
            <a href='todo.php?delete=true&id={$row["id"]}'><ion-icon class='text-danger' name='trash-bin'></ion-icon></a>&nbsp;
            ";


            echo "
            <div class='tasks content  mb-4 todo-card d-flex justify-content-between {$hide}'>
            <input type='textarea' class='text' name='task' value='{$row["name"]}' readonly />
            <input type='text' class='text' name='id' hidden value='{$row["id"]}' />
            <div class='actions d-flex justify-content-between align-items-center'>
           {$actions}</div>
        </div>

            ";
        }
    } else {
        echo '<li>no existing todos</li>';
    }

    mysqli_close($dbConnection);
}
// delete todo from db
function deleteTodo($dbConnection, $id)
{

    if (mysqli_query($dbConnection, "DELETE FROM `todos` WHERE `todos`.`id` = '$id';")) {
    } else {
        echo mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
    header("Location: todo.php");
}

// complete todo from db
function completeTodo($dbConnection, $id)
{

    if (mysqli_query($dbConnection, "UPDATE `todos` SET `isCompleted` = '1' WHERE `todos`.`id` = '$id'")) {
    } else {
        echo mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
    header("Location: todo.php");
}

// undo complete todo from db
function undoCompleteTodo($dbConnection, $id)
{

    if (mysqli_query($dbConnection, "UPDATE `todos` SET `isCompleted` = '0' WHERE `todos`.`id` = '$id'")) {
    } else {
        echo mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
    header("Location: todo.php");
}

// create user
function createUser($dbConnection, $name, $password)
{

    if (mysqli_query($dbConnection, "INSERT INTO `users` (`ID`, `email`, `password`) VALUES (NULL, '$name', '$password');")) {
        header("Location: login.php");

        echo '<script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("info-card").innerHTML =
              "<p >Account created successfully. Login</p>";
            document.getElementById("info-card").classList.add("p-4");
          });
          
      
          </script>';
    } else {
        header("Location: signup.php");

        echo '<script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("error-div").innerHTML =
              "Error please try again";
          });
        </script>';

        echo mysqli_error($dbConnection);
    }

    mysqli_close($dbConnection);
}


function loginUser($dbConnection, $email, $password)
{

    $user = mysqli_query($dbConnection, "SELECT * FROM users WHERE email ='$email' AND password ='$password';");

    if (mysqli_num_rows($user) > 0) {
        session_start();

        while ($row = mysqli_fetch_assoc($user)) {
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] =  $row["password"];
            $_SESSION["userId"] =  $row["ID"];
        }


        header("Location: todo.php");
    } else {
        echo '<script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("error-div").innerHTML =
              "user not found. please try again";
          
          });
        </script>';
        echo mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
}

// create Todo task
function createTodo($dbConnection, $taskName)
{
    $user = $_SESSION["userId"];

    if (mysqli_query($dbConnection, "INSERT INTO `todos` (`name`, `id`, `user`) VALUES ('$taskName', NULL, $user);")) {
    } else {
        echo mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
    header("Location: todo.php");
}
