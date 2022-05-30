<?php

function writeJson(object $db)
{
    $file = fopen('names.db', 'w');
    fputs($file, json_encode($db));
    fclose($file);
}

function readJson()
{
    $file = fopen('names.db', 'r');
    $namesDb = json_decode(fgets($file));

    foreach ($namesDb->names as $name) {
        echo $name->task;
    }

    // $namesDb->names = array de objetos

    // dados puros
    $data = [
        'id'=> 3,
        'task' => "Sheila",
        'complete' => false
    ];

    $jsonString = json_encode($data);

    $jsonObject = json_decode($jsonString);

    $namesDb->names[] = $jsonObject;

    writeJson($namesDb);

    fclose($file);
}

readJson();
