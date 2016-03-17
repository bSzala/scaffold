<?php
namespace BSzala\Scaffold\Commands;

use BSzala\Scaffold\Helpers\PathHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InstallGeneralAliasesCommand
 *
 * Install's a general aliases command - most common/used aliases
 *
 * @package BSzala\Scaffold\Commands
 */
class InstallGeneralAliasesCommand extends AliasesCommand
{


    /**
     * Command name
     */
    const COMMAND_NAME = 'aliases:general';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription("Install a general, most used aliases.");
    }

    /**
     * Execute this command
     *
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Started Installing!</info>');
        if(!$this->createUserAliasesDirectory()){
            $output->writeln('<comment>Failure</comment> Aliases directory cannot be created. Installation failed.');
            return;
        }

        $this->mirror(PathHelper::getGeneralAliasesPath(),$this->getUserAliasesPath());


        $output->writeln(sprintf('<comment>%s</comment> has been installed.', 'General aliases'));
    }
}