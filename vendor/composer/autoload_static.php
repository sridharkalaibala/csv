<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit37bdb91fb7b005f7d10eefab666a4d7e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'ParseCsv\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ParseCsv\\' => 
        array (
            0 => __DIR__ . '/..' . '/parsecsv/php-parsecsv/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit37bdb91fb7b005f7d10eefab666a4d7e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit37bdb91fb7b005f7d10eefab666a4d7e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit37bdb91fb7b005f7d10eefab666a4d7e::$classMap;

        }, null, ClassLoader::class);
    }
}