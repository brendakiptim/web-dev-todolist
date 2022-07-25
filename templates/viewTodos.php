<?php
require_once 'utils.php';
?>

<main>
    <section class="task-list">
        <h2>TASKS</h2>
        <hr>
        <div id="tasks">
            <?php fetchTodos($dbConnection); ?>

        </div>
        <hr>
        <?php include('./templates/viewCompletedTodos.php') ?>

    </section>
</main>