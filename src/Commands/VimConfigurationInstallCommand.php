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
     * Vim plugin manager
     */
    const VIM_VUNDLE_GITHUB_URL = 'https://github.com/VundleVim/Vundle.vim.git';
    /**
     * Command name
     */
    const COMMAND_NAME = 'vim:install';

    /**
     * Target directory argument
     */
    const TARGET_DIR_ARGUMENT = 'target';
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription("Install BSzala Vim Configuration into Your home directory.")
            ->addArgument(
                self::TARGET_DIR_ARGUMENT,
                InputArgument::OPTIONAL,
                'Specify a target directory to install vim configuration. By default User home dir will be used',
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
        $targetDirectory = $input->getArgument(self::TARGET_DIR_ARGUMENT);
        if($targetDirectory == self::TARGET_DEFAULT_DIRECTORY)
            $targetDirectory = $this->getUserHomeDirectory();

        if(empty($targetDirectory))
            $targetDirectory= self::TARGET_DEFAULT_DIRECTORY;

        $exists = $this->vimConfigurationExists($targetDirectory);

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

        if(!$this->hasGit()){
            $output->writeln('<comment>Git is not installed on Your OS. Installation failed!</comment>');
            return;
        }else{
            $output->writeln('<info>Started Installing!</info>');
            $this->mirror(PathHelper::getVimConfigPath(), $targetDirectory,$exists);
            $this->cloneVimPluginManager($targetDirectory);
            //$this->installVimPlugins();
        }
        $output->writeln(sprintf('<comment>%s</comment> installed into <info>%s</info>', 'Vim configuration', 'Your home directory'));
    }

    /**
     * Checks if vim configuration already exists in home user directory
     *
     * @param string $directory Directory to check
     * @return bool
     */
    protected function vimConfigurationExists($directory)
    {
        $directory = rtrim($directory, '/') . '/';

        if ($this->exists($directory . '.vimrc') || $this->exists($directory . '.vim'))
            return true;
        return false;
    }

    /**
     * Clone vim plugin manager
     *
     * @param string $targetDirectory Target directory
     * @return bool True if success, otherwise false
     */
    protected function cloneVimPluginManager($targetDirectory)
    {
        $targetDirectory = rtrim($targetDirectory, '/') . '/';
        exec('git clone  '.self::VIM_VUNDLE_GITHUB_URL.' '.$targetDirectory.'.vim/bundle/Vundle.vim');
    }



}