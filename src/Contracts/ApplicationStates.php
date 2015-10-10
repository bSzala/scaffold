<?php namespace Fenix440\Scaffold\Contracts;

/**
 * Interface ApplicationStates
 *
 * A component must know about application states
 * like: version, name etc.
 *
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 * @package      Fenix440\Scaffold\Contracts
 */
interface ApplicationStates
{

    /**
     * Application name
     */
    const NAME = 'Scaffolding utility tool';

    /**
     * Application version
     */
    const VERSION = '1.0';
}