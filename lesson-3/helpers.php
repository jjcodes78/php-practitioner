<?php

function view($name, array $params = [])
{
    extract($params);

    return require "views/{$name}.view.php";
}
