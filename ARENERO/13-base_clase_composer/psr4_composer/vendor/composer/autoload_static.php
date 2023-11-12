<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7ffbf8e48db08102f51ac43df8d1b4c2
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Webtechnologies\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Webtechnologies\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Webtechnologies',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Webtechnologies\\Controllers\\AccountController' => __DIR__ . '/../..' . '/app/Webtechnologies/Controllers/AccountController.php',
        'Webtechnologies\\Controllers\\UserController' => __DIR__ . '/../..' . '/app/Webtechnologies/Controllers/UserController.php',
        'Webtechnologies\\Models\\Account' => __DIR__ . '/../..' . '/app/Webtechnologies/Models/Account.php',
        'Webtechnologies\\Models\\User' => __DIR__ . '/../..' . '/app/Webtechnologies/Models/User.php',
        'Webtechnologies\\Views\\AccountTemplate' => __DIR__ . '/../..' . '/app/Webtechnologies/Views/AccountTemplate.php',
        'Webtechnologies\\Views\\UserTemplate' => __DIR__ . '/../..' . '/app/Webtechnologies/Views/UserTemplate.php',
        'Webtechnologies\\config\\App' => __DIR__ . '/../..' . '/app/Webtechnologies/config/App.php',
        'Webtechnologies\\config\\Dev' => __DIR__ . '/../..' . '/app/Webtechnologies/config/Dev.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7ffbf8e48db08102f51ac43df8d1b4c2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7ffbf8e48db08102f51ac43df8d1b4c2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7ffbf8e48db08102f51ac43df8d1b4c2::$classMap;

        }, null, ClassLoader::class);
    }
}
