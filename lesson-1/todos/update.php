<?php

require '../database/functions.php';

if (isset($_POST['id'])) {
    update($_POST['id']);
}

header("Location: ../index.php");
