<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca0267e8c1e44ab2146bfca42483b27b
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitca0267e8c1e44ab2146bfca42483b27b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitca0267e8c1e44ab2146bfca42483b27b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
