<?php

namespace App\Core;

use Exception;

class Application
{
    protected array $instances = [];

    protected array $facades = [];

    protected static Application $instance;

    public static function make(): Application
    {
        self::$instance = new static;
        return self::$instance;
    }

    public static function getInstance(): Application
    {
        return self::$instance;
    }

    public function registerFacades(array $facades): void
    {
        foreach ($facades as $abstract => $concrete) {
            $this->facades[$abstract] = $concrete;
        }
    }

    public function singleton(string $abstract, string $concrete, array $parameters = []): void
    {
        $this->instances[$abstract] = new $concrete(...$parameters);
    }

    /**
     * @throws Exception
     */
    public function resolve(string $abstract, array $parameters = []): mixed
    {
        if(in_array($abstract, array_keys($this->facades))) {
            $concrete = $this->facades[$abstract];
            return (new $concrete(...$parameters));
        }

        if(in_array($abstract, array_keys($this->instances))) {
            return $this->instances[$abstract];
        }

        throw new Exception("Failed to resolve {$abstract} class. Bind this class into Application!");
    }
}
