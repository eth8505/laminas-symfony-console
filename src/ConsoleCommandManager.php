<?php
/**
 * @copyright 2020 Jan-Simon Winkelmann <winkelmann@blue-metallic.de>
 * @license MIT
 */

namespace LaminasSymfonyConsole;

use Symfony\Component\Console\Command\Command;
use Laminas\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager for console commands
 */
class ConsoleCommandManager extends AbstractPluginManager
{

    /**
     * Base class must be symfony console command
     *
     * @var string
     */
    protected $instanceOf = Command::class;

    /**
     * Create all commands and return as generator
     *
     * @return \Generator|Command[]
     */
    public function createAllCommands(): \Generator
    {

        foreach ($this->factories AS $serviceName => $factoryName) {
            yield $this->get($serviceName);
        }

    }

}
