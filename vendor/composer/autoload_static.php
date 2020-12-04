<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit57f86ba4e0eec8c14723aab077f198a3
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'ManaPHP\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ManaPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/manaphp/framework',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit57f86ba4e0eec8c14723aab077f198a3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit57f86ba4e0eec8c14723aab077f198a3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
