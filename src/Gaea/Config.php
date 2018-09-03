<?php
namespace Gaea;

use Gaea\Exception\ConfigException;

class Config {

    private static $configStore;

    public static function get($name)
    {
        if (empty($name)) {
            return null;
        }

        self::load();

        if (isset(self::$configStore['CONFIG'][$name])) {
            return self::$configStore['CONFIG'][$name];
        }
        return null;
    }

    private static function load()
    {
        if (!empty(self::$configStore)) {
            return self::$configStore;
        }

        $root = __DIR__ . "/src/";
        $configFile = $root ."gaea.ini";

        self::$configStore['ROOT_DIR'] = $root;
        self::$configStore['CONFIG_FILE'] = $configFile;

        if (!file_exists($configFile)) {
            throw new ConfigException("Config file missing: " .$configFile);
        }

        $config = parse_ini_file($configFile);
        if ($config === false) {
            throw new ConfigException("Ini file parse error:" .$configFile);
        }
        self::$configStore['CONFIG'] = $config;
    }
}
