<?php

namespace GameOfLife\Util;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class ServiceContainer
 *
 * @package GameOfLife\Util
 */
final class ServiceContainer
{
    const SERVICES_DIR = '/../../../resources/';
    const SERVICES_FILE = 'services.xml';

    /**
     * @var Container
     */
    private static $container;

    /**
     * @param string $serviceName
     * @return object
     */
    public static function getService($serviceName)
    {
        static::loadContainer();
        return static::$container->get($serviceName);
    }

    /**
     * prevent class instantiation
     */
    private function __construct()
    {
    }

    /**
     * prevent instance cloning
     */
    private function __clone()
    {
    }

    private static function loadContainer()
    {
        if (null !== static::$container) {
            return;
        }

        static::$container = new ContainerBuilder();
        $loader = new XmlFileLoader(
            static::$container,
            new FileLocator(__DIR__ . self::SERVICES_DIR)
        );
        $loader->load(self::SERVICES_FILE);
        static::$container->compile();
    }
}
