<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc1791dabc38cee7d6b7e1dd91f4d518e
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitc1791dabc38cee7d6b7e1dd91f4d518e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc1791dabc38cee7d6b7e1dd91f4d518e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc1791dabc38cee7d6b7e1dd91f4d518e::$classMap;

        }, null, ClassLoader::class);
    }
}
