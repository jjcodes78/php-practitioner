<?php

use App\Core\Application;

function view($name, array $params = [])
{
    extract($params);

    return require "views/{$name}.view.php";
}

function app(): Application
{
    return Application::getInstance();
}


function dd($args): void
{
    var_dump($args);
    die();
}
