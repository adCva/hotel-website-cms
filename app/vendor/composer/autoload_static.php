<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac87b1787c69c56c397f23e09f948867
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac87b1787c69c56c397f23e09f948867::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac87b1787c69c56c397f23e09f948867::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitac87b1787c69c56c397f23e09f948867::$classMap;

        }, null, ClassLoader::class);
    }
}