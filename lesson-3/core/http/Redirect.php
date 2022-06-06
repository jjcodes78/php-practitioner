<?php

namespace App\Core\Http;

class Redirect
{
    public static function to($route, $status = 302)
    {
        // Usa a função header do PHP para reescrever o header da requisição
        // Usa-se um caminho definido em $route para apontar
        // para onde a requisição deve voltar.
        header("Location: {$route}", true, $status);
    }
}
