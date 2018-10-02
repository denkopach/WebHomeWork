<?php

class Configs
{
    private static $configs;

    public static function getPath ()
    {
        return self::$configs;
    }

    public static function setPath ($configs)
    {
        self::$configs = $configs;
    }
}
