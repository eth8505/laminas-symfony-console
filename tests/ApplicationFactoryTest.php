<?php

declare(strict_types=1);

namespace LaminasSymfonyConsoleTest\Factory;

use Laminas\ServiceManager\ServiceManager;
use LaminasSymfonyConsole\ConsoleCommandManager;
use LaminasSymfonyConsole\Factory\ApplicationFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class ApplicationFactoryTest extends TestCase
{
    public function testFactory(): void
    {
        $container = $this->createMock(ServiceManager::class);
        $commandManager = $this->createMock(ConsoleCommandManager::class);
        $dummyCommand = new class() extends Command {

            protected static $defaultName = 'dummy';
        };
        $commandManager->expects($this->once())
            ->method('createAllCommands')
            ->willReturn(
                (function () use ($dummyCommand) {

                    yield $dummyCommand;
                })()
            );

        $container->expects($this->exactly(2))
            ->method('get')
            ->willReturnMap(
                [
                    ['Config', []],
                    [ConsoleCommandManager::class, $commandManager]
                ]
            );

        $factory = new ApplicationFactory();
        $instance = $factory(
            $container,
            'dummy'
        );

        $this->assertInstanceOf(Application::class, $instance);
        $this->assertEquals('eth8505 laminas-symfony-console', $instance->getName(), 'default version not set');
        $this->assertEquals('dev', $instance->getVersion());

        $this->assertSame($dummyCommand, $instance->get('dummy'), 'incorrect command');
    }
}
