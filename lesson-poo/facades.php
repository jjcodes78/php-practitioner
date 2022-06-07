<?php

// classes
// propriedades
// métodos
// static
// método estático acessor
// composer
// autoloader
// classmap
// psr-4 (namespaces)
// mvc -> rota / controller / view / model

// facades -> classe que acessa outra classe estaticamente
//
class Database {

    public function connect(string $a = "valor A", string $b = "valor B")
    {
        echo "Chamando connect via facade. Args: $a e $b";
    }
}

class DatabaseFacade {
    public static function __callStatic(string $name, array $arguments)
    {
        return (new Database)->$name(...$arguments);
    }
}

DatabaseFacade::connect("C", "D");
