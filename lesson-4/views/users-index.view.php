<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>USERS</h1>

<ul class="todo-list">
    <?php foreach ($users as $user): ?>
        <li>
            <div class="view">
                <input class="toggle" type="checkbox">
                <label><?= $user->name ?> - <?= $user->email ?> </label>
                <button class="destroy"></button>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
