<?php

function view($name, array $params = [])
{
    extract($params);

    return require "views/{$name}.view.php";
}

function dd($args)
{
    var_dump($args);
    die();
}
