<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitdef81c79c7e7c5297f7ef8e9511a557c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitdef81c79c7e7c5297f7ef8e9511a557c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitdef81c79c7e7c5297f7ef8e9511a557c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitdef81c79c7e7c5297f7ef8e9511a557c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}