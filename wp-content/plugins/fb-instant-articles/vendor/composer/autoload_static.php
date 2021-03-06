<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8b1e91281cd41e15c5fb1bef205d265f
{
    public static $files = array (
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\CssSelector\\' => 30,
        ),
        'F' => 
        array (
            'Facebook\\InstantArticles\\' => 25,
            'Facebook\\' => 9,
        ),
        'D' => 
        array (
            'Doctrine\\Instantiator\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\CssSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/css-selector',
        ),
        'Facebook\\InstantArticles\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/facebook-instant-articles-sdk-extensions-in-php/src/Facebook/InstantArticles',
            1 => __DIR__ . '/..' . '/facebook/facebook-instant-articles-sdk-php/src/Facebook/InstantArticles',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
        'Doctrine\\Instantiator\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/instantiator/src/Doctrine/Instantiator',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8b1e91281cd41e15c5fb1bef205d265f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8b1e91281cd41e15c5fb1bef205d265f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
