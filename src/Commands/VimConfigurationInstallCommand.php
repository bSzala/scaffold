<?php
namespace BSzala\Scaffold\Commands;

use BSzala\Scaffold\Helpers\PathHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Class Vim Configuration Install Command
 *
 * Install a Vim configuration into current user home directory
 *
 * @package BSzala\Scaffold\Commands
 *
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class VimConfigurationInstallCommand extends BaseCommand
{

    /**
     * Target directory for vim configuration
     */
    const TARGET_DEFAULT_DIRECTORY = '~/';
    /**
     * Command name
     */
    const COMMAND_NAME = 'vim:install';

    /**
     * Argument name
     */
    const ARGUMENT_TARGET_DIR_NAME = 'target_dir';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription("Install BSzala Vim Configuration into Your home directory.")
            ->addArgument(
                self::ARGUMENT_TARGET_DIR_NAME,
                InputArgument::OPTIONAL,
                'Specify a target directory, where template should be installed. By default Vim Configuration will be installed in You home directory',
                self::TARGET_DEFAULT_DIRECTORY
            );
    }

    /**
     * Execute this command
     *
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $targetDirectory = $input->getArgument(self::ARGUMENT_TARGET_DIR_NAME);

        $exists = false;
        if ($this->isVimConfigurationExists($targetDirectory))
            $exists = true;

        if ($exists) {
            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion(
                sprintf('<info>It appears, that vim configuration already exists in "%s" directory, should I override this configuration?</info> <comment>[Y/N=default]</comment>',$targetDirectory),
                false
            );
            if (!$helper->ask($input, $output, $question)) {
                $output->writeln(sprintf('Installation has been canceled! '));
                return;
            }
        }

        $output->writeln('<info>Started Installing!</info>');
        $this->mirror(PathHelper::getVimConfigPath(), $targetDirectory);
        $output->writeln(sprintf('<comment>%s</comment> installed into <info>%s</info>', 'Vim configuration', 'Your home directory'));
    }

    /**
     * Checks if vim configuration already exists in home user directory
     *
     * @param string $directory Directory to check
     * @return bool
     */
    protected function isVimConfigurationExists($directory)
    {
        if ($this->exists($directory . '.vimrc') || $this->exists($directory . '.vim'))
            return true;
        return false;
    }


}