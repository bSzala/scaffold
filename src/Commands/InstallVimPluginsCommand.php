<?php
namespace BSzala\Scaffold\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InstallVimPluginsCommand
 *
 * @package BSzala\Scaffold\Commands
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class InstallVimPluginsCommand extends BaseCommand
{

    /**
     * Command name
     */
    const COMMAND_NAME = 'vim:install-plugins';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription("Install All vim plugins handled by vundle vim plugin manager.");
    }

    /**
     * Execute this command
     *
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
            $output->writeln('<info>Started Installing!</info>');
            $this->installVimPlugins();

        $output->writeln(sprintf('<comment>%s</comment> has been installed.', 'Vim plugins'));
    }
}