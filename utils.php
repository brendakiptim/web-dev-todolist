<!-- connect to db -->
<?php $dbConnection = mysqli_connect("localhost", "root", "", "web-dev-todolist");
if (!$dbConnection) {
    echo 'Database connection error ' . mysqli_connect_error();
}

function fetchUsers($dbConnection)
{
    $users = mysqli_query($dbConnection, "SELECT * FROM users;");
    if (mysqli_num_rows($users) > 0) {
        while ($row = mysqli_fetch_assoc($users)) {
            echo $row["name"];
        }
    } else {
        echo '<p>no existing users</p>';
    }

    mysqli_close($dbConnection);
}


function fetchTodos($dbConnection)
{

    $todos = mysqli_query($dbConnection, "SELECT * FROM `todos`;");
    if (mysqli_num_rows($todos) > 0) {
        while ($row = mysqli_fetch_assoc($todos)) {

            echo "<li> Todo item {$row["id"]}: {$row["name"]} - {$row["due_date"]}</li>";
        }
    } else {
        echo '<li>no existing todos</li>';
    }

    mysqli_close($dbConnection);
}

function createTableRoles($dbConnection)
{
    $sql = "CREATE TABLE test(
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(45) NOT NULL,
        lastname  VARCHAR(50) NOT NULL
    );";
    if (mysqli_query($dbConnection, $sql)) {
        echo "Table test created";
    } else {
        echo "Error creating table " . mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
}

function populateTable($dbConnection)
{
    $sql = "INSERT INTO `test` (`id`, `firstname`, `lastname`) VALUES (NULL, 'student', 'kiptim')";
    if (mysqli_query($dbConnection, $sql)) {
        echo "data added";
    } else {
        echo "error adding data" . mysqli_error($dbConnection);
    }
    mysqli_close($dbConnection);
}
