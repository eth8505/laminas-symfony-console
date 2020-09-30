<?php
/**
 * @copyright 2020 Jan-Simon Winkelmann <winkelmann@blue-metallic.de>
 * @license MIT
 */

namespace LaminasSymfonyConsole\Factory;

use LaminasSymfonyConsole\ConsoleCommandManager;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Factory class for console application
 */
class ApplicationFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $config = $container->get('Config')['laminas-symfony-console'] ?? [];

        $app = new Console\Application(
            $config['application']['name'] ?? 'eth8505 laminas-symfony-console',
            $config['application']['version'] ?? 'dev'
        );

        foreach ($container->get(ConsoleCommandManager::class)->createAllCommands() AS $command) {
            $app->add($command);
        }

        return $app;

    }

}
