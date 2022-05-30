<h1>About Page</h1>

<form action="/about" method="POST">
    <input type="text" name="task">
    <button type="submit">Salvar</button>
</form>

<hr>

<ul>
    <?php
    foreach ($tasks as $task):
    ?>
    <li><?= $task->task ?></li>
    <?php endforeach; ?>
</ul>
