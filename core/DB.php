<?php

namespace core;

class DB
{
    private static $instance;

    public static function connect()
    {
        if(self::$instance === null) {
            self::$instance = self::getConnect();
        }
        return self::$instance;
    }

    private static function getConnect()
    {
        $opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $dsn = sprintf('%s:host=%s;dbname=%s;', 'mysql', 'localhost', 'modul1');
        return new \PDO($dsn, 'root', 'root', $opt);
    }
}