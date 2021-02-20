LaminasSymfonyConsole - Laminas Module to integrate Symfony Console
===================================================================

The **LaminasSymfonyConsole** module allows to use the symfony console component with Laminas.

[![CI Status](https://github.com/eth8505/laminas-symfony-console/workflows/phpunit/badge.svg)](https://github.com/eth8505/laminas-symfony-console/actions)
![Packagist](https://img.shields.io/packagist/dt/eth8505/laminas-symfony-console.svg)
![Packagist Version](https://img.shields.io/packagist/v/eth8505/laminas-symfony-console.svg)
![PHP from Packagist](https://img.shields.io/packagist/php-v/eth8505/laminas-symfony-console.svg)

## How to install

Install `eth8505/laminas-symfony-console` package via composer.

~~~bash
$ composer require eth8505/laminas-symfony-console
~~~

Load the module in your `application.config.php` file like so:

~~~php
<?php

return [
	'modules' => [
		'LaminasSymfonyConsole',
		// ...
	],
];
~~~

## How to use

You can use the `vendor/bin/console` tool to run your commands. This tool may be in a different directory depending on 
how your composers `bin-dir` is configured.

Depending on how you did setup your Laminas project, you might need to modify `public/index.php`.
For example this is neccassary if you did use the Laminas MVC Skeleton project.

Firstly that file has to return the `Application` instance for this library to work.

Optionally you might only invoke the `run()` method of `Laminas\Mvc\Application` if `public/index.php` has not
been called via the PHP CLI. This will avoid cluttering up your console with the view.

## How do I create console commands?

### 1. Create command
Create commands as described in the [symfony console docs](https://symfony.com/doc/current/console.html). Please note
that if you're using a fully-fledged laminas framework, it won't be possible to use all the nice symfony service container
logic.

### 2. Register with service manager
You can either register your commands with the service manager via the config in your `module.config.php`:
~~~php
<?php

return [
    'laminas_symfonyconsole_commands' => [
        'invokables' => [
            MyCommand::class
        ]
    ]
];
~~~

or register it in your module class using the `ConsoleCommandProviderInterface`:
~~~php
<?php

namespace MyModule;

use LaminasSymfonyConsole\ConsoleCommandProviderInterface;

class Module implements ConsoleCommandProviderInterface {
    
    /**
     * @inheritdoc 
     */
    public function getConsoleCommandConfig() {

        return [
            'invokables' => [
                MyCommand::class
            ]
        ];
        
    }
    
}
~~~

### 3. Your command is ready to go
Your command will now show up when using the `bin/console` utility and can be called with whatever you set up in the
 commands `configure` method.
 
### Thanks
Thanks to [Rafi Adnan](https://github.com/radnan) and his [RDN Console](https://github.com/radnan/rdn-console) module
which this module is loosely based upon.
