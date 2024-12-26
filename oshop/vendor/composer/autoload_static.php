<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc29bce2002f3a84edde9121b03fa2059
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc29bce2002f3a84edde9121b03fa2059::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc29bce2002f3a84edde9121b03fa2059::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc29bce2002f3a84edde9121b03fa2059::$classMap;

        }, null, ClassLoader::class);
    }
}
