<?php
require_once 'utils.php';
?>

<main>
    <section class="task-list">
        <h2>TASKS</h2>
        <div id="tasks">
            <?php fetchTodos($dbConnection); ?>

        </div>
    </section>
</main>