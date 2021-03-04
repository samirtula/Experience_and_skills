<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdfe233f45779056abaac3bdd2ad53852
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdfe233f45779056abaac3bdd2ad53852::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdfe233f45779056abaac3bdd2ad53852::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdfe233f45779056abaac3bdd2ad53852::$classMap;

        }, null, ClassLoader::class);
    }
}
