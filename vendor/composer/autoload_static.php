<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3a82779a054d4a05c6b4e069ed3c1dd2
{
    public static $classMap = array (
        'Feed' => __DIR__ . '/..' . '/dg/rss-php/src/Feed.php',
        'FeedException' => __DIR__ . '/..' . '/dg/rss-php/src/Feed.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit3a82779a054d4a05c6b4e069ed3c1dd2::$classMap;

        }, null, ClassLoader::class);
    }
}