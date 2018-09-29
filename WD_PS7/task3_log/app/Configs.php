<?php

class Configs
{
    private static $configs;

    public function get ()
    {
        return self::$configs;
    }

    public function set ($configs)
    {
        self::$configs = $configs;
    }
}
