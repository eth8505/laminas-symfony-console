<?php
/**
 * @copyright 2020 Jan-Simon Winkelmann <winkelmann@blue-metallic.de>
 * @license MIT
 */

namespace LaminasSymfonyConsole;

use LaminasSymfonyConsole\Factory\ApplicationFactory;
use LaminasSymfonyConsole\Factory\ConsoleCommandManagerFactory;
use Interop\Container\ContainerInterface;
use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Laminas\ModuleManager\Listener\ServiceListener;
use Laminas\ModuleManager\ModuleManager;
use Laminas\ModuleManager\ModuleManagerInterface;

/**
 * ZF3 Symfony console module class
 */
class Module implements InitProviderInterface, ServiceProviderInterface
{

    /**
     * @inheritdoc
     */
    public function init(ModuleManagerInterface $manager) {

        /** @var ModuleManager $manager */
        /** @var ContainerInterface $serviceManager */
        $serviceManager = $manager->getEvent()->getParam('ServiceManager');
        /** @var ServiceListener $serviceListener */
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            ConsoleCommandManager::class,
            'laminas_symfonyconsole_commands',
            ConsoleCommandProviderInterface::class,
            'getConsoleCommandConfig'
        );

    }

    /**
     * @inheritdoc
     */
    public function getServiceConfig() {

	    return [
	        'factories' => [
	            'LaminasSymfonyConsole\\Application' => ApplicationFactory::class,
                ConsoleCommandManager::class => ConsoleCommandManagerFactory::class
            ]
        ];

    }

}
