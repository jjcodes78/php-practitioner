<?php

require '../database/functions.php';

if (isset($_POST['id'])) {
    delete($_POST['id']);
}

header("Location: ../index.php");
