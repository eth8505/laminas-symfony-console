<?php
/**
 * @copyright 2020 Jan-Simon Winkelmann <winkelmann@blue-metallic.de>
 * @license MIT
 */

namespace LaminasSymfonyConsole;

/**
 * Hinting interface for configuration of console commands via module classes
 */
interface ConsoleCommandProviderInterface
{

    /**
     * Get console command config
     *
     * @return array
     */
    public function getConsoleCommandConfig();

}
