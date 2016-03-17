<?php
namespace BSzala\Scaffold\Commands;

/**
 * Class InstallGeneralAliasesCommand
 *
 * Install's a general aliases command - most common/used aliases
 *
 * @package BSzala\Scaffold\Commands
 */
class InstallGeneralAliasesCommand extends BaseCommand
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
            ->setDescription("It will install a general, most used aliases.");
    }

    /**
     * Execute this command
     *
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Started Installing!</info>');
       //@todo

        $output->writeln(sprintf('<comment>%s</comment> has been installed.', 'General aliases'));
    }
}