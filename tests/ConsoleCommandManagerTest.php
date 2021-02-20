<?php

declare(strict_types=1);

namespace LaminasSymfonyConsoleTest;

use Laminas\ServiceManager\ServiceManager;
use LaminasSymfonyConsole\ConsoleCommandManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;

class ConsoleCommandManagerTest extends TestCase
{
    public function testCreateAllCommands(): void
    {
        $dummyCommand = $this->createMock(Command::class);

        $container = new ServiceManager();
        $commandManager = new ConsoleCommandManager($container);
        $commandManager->setAllowOverride(true);
        $commandManager->setFactory(
            'dummycommand',
            function () use ($dummyCommand) {

                return $dummyCommand;
            }
        );
        $commands = iterator_to_array($commandManager->createAllCommands());

        $this->assertSame($commands[0], $dummyCommand, 'command does not match');
    }
}
