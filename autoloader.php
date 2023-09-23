<?php

function autoloader($className): void
{
    $filePath = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
}

spl_autoload_register('autoloader');