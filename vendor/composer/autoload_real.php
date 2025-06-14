<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc500a4907e07fe35eeef80d5505fbd49
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

        spl_autoload_register(array('ComposerAutoloaderInitc500a4907e07fe35eeef80d5505fbd49', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc500a4907e07fe35eeef80d5505fbd49', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc500a4907e07fe35eeef80d5505fbd49::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
