<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit41d6ee80de40de5f5d53e96315814ad6
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Theme\\General\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Theme\\General\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit41d6ee80de40de5f5d53e96315814ad6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit41d6ee80de40de5f5d53e96315814ad6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
