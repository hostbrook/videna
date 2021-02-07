<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit50b937a680f0ae66bb391dc5a250f47b
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Videna\\' => 7,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Videna\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Videna',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit50b937a680f0ae66bb391dc5a250f47b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit50b937a680f0ae66bb391dc5a250f47b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit50b937a680f0ae66bb391dc5a250f47b::$classMap;

        }, null, ClassLoader::class);
    }
}
