<?php

namespace App\Core;

class Application
{
    public static function start()
    {
        // Antes de dar continuidade na requisição
        // importamos as rotas da aplicação registradas
        // no arquivo routes.php
        require __DIR__ . "/../routes.php";

        // Ao saber quais rotas estão registradas pela aplicação.
        // Chamamos o método resolve do Router para que
        // resolva a requisição e devolva (ou não) uma resposta.
        Router::resolve();
    }
}
