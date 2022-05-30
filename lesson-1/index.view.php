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
<h1>FORM POST</h1>
<form action="/todos/store.php" method="post">
    <label for="name">Nome</label>
    <input type="text" name="name">
    <button type="submit">Enviar</button>
</form>

<hr>
<table>
    <thead>
        <th></th>
        <th>ID</th>
        <th>Nome</th>
        <th></th>
    </thead>
    <tbody>
    <?php foreach (getAll() as $name): ?>
        <tr>
            <td>
                <form action="/todos/update.php" method="post" id="<?php echo('form-' . $name[0]) ?>">
                    <input <?php if(intval($name[2])) echo 'checked'; ?>
                            onclick="taskMark(this)"
                            type="checkbox"
                            value="<?= $name[0] ?>">
                    <input type="hidden" name="id" value="<?= $name[0] ?>">
                </form>
            </td>
            <td><?= $name[0] ?></td>
            <td>
                <?php
                    if(intval($name[2])) {
                        echo "<s>$name[1]</s>";
                    }else {
                        echo $name[1];
                    }
                ?>
            </td>
            <td>
                <form action="/todos/destroy.php" method="post">
                    <input type="hidden" name="id" value="<?= $name[0] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    function taskMark(el) {
        formID = 'form-' + el.value
        form = document.getElementById(formID)
        form.submit()
    }
</script>


<form action="/" method="post">
    <input type="hidden" name="_clear">
</form>

</body>
</html>
