<?php

const DB_DATA = "names.db";
const DB_INDEX = "names.idx";

function getAll()
{
    $names = [];
    if (file_exists(DB_DATA)) {
        $file = fopen(DB_DATA, 'r+');
        while (!feof($file)) {
            $row = fgets($file);
            $fields = explode(",", $row);
            if (count($fields) == 3) {
                $names[] = $fields;
            }
        }
        fclose($file);
    }

    return $names;
}

function save($name) //dbInclude
{
    $nextId = getNextId();
    if ($file = fopen('../' . DB_DATA, 'a+')) {
        $newRow = implode(",", [$nextId, $name, 0]);
        fputs($file, $newRow . PHP_EOL);
        fclose($file);
    }

    // atualiza o indice
    if ($file = fopen('../' . DB_INDEX, 'w+')) {
        fputs($file, $nextId);
        fclose($file);
    }
}

function getNextId() //
{
    if ($file = fopen('../' . DB_INDEX, 'r+')) {
        $currentId = fgets($file);
        fclose($file);
        return intval($currentId) + 1;
    }
}

// algoritmo: delete
// post -> id do registro a ser deletado
// abrir o arquivo
// percorrer linha a linha comparando o id da linha com o id do post
// se a linha não corresponder ao id do post , armazenar ela num array temporario para gravar futuramente de volta no db
// se a linha corresponder tu ignora ela e continua ate o final do arquivo
// rebrir o arquivo em modo escrita (w) e não append (a) // zerar ... e iniciar tudo de novo
// percorrer o array temporario e escrever cada item desse array no arquivo db

function delete($id)
{
    $tempArray = [];
    if ($file = fopen('../'. DB_DATA, 'r+')) {
        while (!feof($file)) {
            $row = fgets($file);
            $fields = explode(",", $row);
            if (count($fields) == 3 && ($id != intval($fields[0]))) {
                $tempArray[] = $fields;
            }
        }
        fclose($file);
    }

    // rewrite as linhas originais
    dbRewrite($tempArray);
}

function update($id)
{
    $tempArray = [];
    if ($file = fopen('../'. DB_DATA, 'r+')) {
        while (!feof($file)) {
            $row = fgets($file);
            $fields = explode(",", $row);
            if (count($fields) == 3 && ($id == intval($fields[0]))) {
                $fields[2] = ! intval($fields[2]) . PHP_EOL;
            }
            $tempArray[] = $fields;
        }
        fclose($file);
    }

    // rewrite as linhas originais
    dbRewrite($tempArray);
}

function dbRewrite(array $data)
{
    if ($file = fopen('../'. DB_DATA, 'w+')) {
        foreach ($data as $nameArr) {
            $newRow = implode(",", $nameArr);
            fputs($file, $newRow);
        }
        fclose($file);
    }
}
