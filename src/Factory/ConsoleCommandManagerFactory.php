<?php
/**
 * @copyright 2020 Jan-Simon Winkelmann <winkelmann@blue-metallic.de>
 * @license MIT
 */

namespace LaminasSymfonyConsole\Factory;

use LaminasSymfonyConsole\ConsoleCommandManager;
use Laminas\Mvc\Service\AbstractPluginManagerFactory;

/**
 * Factory for console command plugin manager
 */
class ConsoleCommandManagerFactory extends AbstractPluginManagerFactory
{

    const PLUGIN_MANAGER_CLASS = ConsoleCommandManager::class;

}
