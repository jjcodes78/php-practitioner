<?php

require '../database/functions.php';

if (isset($_POST['name'])) {
    save($_POST['name']);
}

header("Location: ../index.php");
