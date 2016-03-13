<?php
namespace BSzala\Scaffold\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Vim Configuration Install Command
 *
 * Install in current user home directory vim configuration
 *
 * @package BSzala\Scaffold\Commands
 *
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class VimConfigurationInstallCommand extends Command
{
    /**
     * Command name
     */
    const COMMAND_NAME = 'vim:install';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription("Install BSzala Vim Configuration in Your home directory.");
    }

    /**
     * Execute this command
     *
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }


}