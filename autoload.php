<?php
spl_autoload_register(function($className)
{
    $basePath = dirname(dirname(__FILE__)) . '/src/';
    $classFile = $basePath . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if (function_exists('stream_resolve_include_path')) {
        $file = stream_resolve_include_path($classFile);
    } else {
        $file = false;
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            if (file_exists($path . '/' . $classFile)) {
                $file = $path . '/' . $classFile;
                break;
            }
        }
    }
    if (($file !== false) && ($file !== null)) {
        include_once $file;
        return;
    }
    throw new RuntimeException($className. ' not found');
});
