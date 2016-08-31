<?php
/**
 * Singleton pattern example
 *
 * @author Albert Colom <skolom@gmail.com>
 * @see https://en.wikipedia.org/wiki/Singleton_pattern
 */

class Singleton
{
    private static $instance;

    public static function getInstance()
    {
        if(static::$instance === null) {
            static::$instance = new static();
        }
        return self::$instance;
    }

    protected function __construct()
    {

    }

    private function __wakeup()
    {
        throw new \Exception('Forbidden __wakeup in Singleton');
    }

    private function __clone()
    {
        throw new \Exception('Forbidden __clone in Singleton');
    }
}

$singleton = Singleton::getInstance();
var_dump($singleton === Singleton::getInstance());
