<!doctype html>
<html lang="en" data-framework="javascript">
<head>
    <meta charset="utf-8">
    <title>PHP • TodoMVC</title>
    <link rel="stylesheet" href="../static/base.css">
    <link rel="stylesheet" href="../static/index.css">
</head>
<body>
<section class="todoapp">
    <header class="header">
        <h1>todos</h1>
        <form action="/tasks" method="POST">
            <input name="task" class="new-todo" placeholder="What needs to be done?" autofocus />
        </form>
    </header>
    <section class="main">
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            <?php foreach ($tasks as $task): ?>
            <li>
                <div class="view">
                    <input class="toggle" type="checkbox">
                    <label><?= $task->task ?></label>
                    <form action="/" method="POST">
                        <input type="hidden" name="id" value="<?= $task->id ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="destroy"></button>
                    </form>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <footer class="footer">
        <span class="todo-count"></span>
        <ul class="filters">
            <li>
                <a href="#/" class="selected">All</a>
            </li>
            <li>
                <a href="#/active">Active</a>
            </li>
            <li>
                <a href="#/completed">Completed</a>
            </li>
        </ul>
        <button class="clear-completed">Clear completed</button>
    </footer>
</section>
<footer class="info">
    <p>Double-click to edit a todo</p>
    <p>Created by <a href="http://twitter.com/oscargodson">Oscar Godson</a></p>
    <p>Refactored by <a href="https://github.com/cburgmer">Christoph Burgmer</a></p>
    <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
</footer>
</body>
</html>
