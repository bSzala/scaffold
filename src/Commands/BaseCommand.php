<?php
namespace BSzala\Scaffold\Commands;

use FilesystemIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

/**
 * Class Base Command
 *
 * Abstract command with additional common methods
 *
 * @package BSzala\Scaffold\Commands
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
abstract class BaseCommand extends Command
{

    
    public function __constructor()
    {
        parent::__construct();
    }
    /**
     * Mirror Files
     *
     * Copy all files from given directory into another one
     *
     * @param string $sourcePath Source full path
     * @param string $targetPath Target full path
     * @param bool $override Override flag, If Yes than all files in target directory will be replaced
     *
     * @return void
     */
    protected function mirror($sourcePath, $targetPath,$override=false)
    {
        (new Filesystem())->mirror($sourcePath,$targetPath,null,['override' => $override]);
    }


    /**
     * Copy all files form given directory into another one
     *
     * @param string $sourcePath Source full path
     * @param string $targetPath Target full path
     * @param bool $override If Yes than all existing files will be replaced
     * @return bool
     */
    protected function copy($sourcePath, $targetPath, $override = false)
    {
        try{
            (new Filesystem())->copy($sourcePath,$targetPath,$override);
        }catch(IOException $ex){
            // copy has failed
            return false;
        }
        return true;

    }

    /**
     * Checks the existence of files or directories.
     *
     * @param string|array|\Traversable $files A filename, an array of files, or a \Traversable instance to check
     *
     * @return bool true if the file exists, false otherwise
     */
    public function exists($files)
    {
        return (new Filesystem())->exists($files);
    }

    /**
     * Install vim plugins from command line
     */
    protected function installVimPlugins()
    {
        exec('vim +PluginInstall +qall');
    }

    /**
     * Checks if git is installed
     *
     * @return bool|string
     */
    protected function hasGit()
    {
        exec('which git', $output);

        $git = file_exists($line = trim(current($output))) ? $line : 'git';

        unset($output);

        exec($git . ' --version', $output);

        preg_match('#^(git version)#', current($output), $matches);

        return ! empty($matches[0]) ? $git : false;
        echo ! empty($matches[0]) ? 'installed' : 'nope';
    }

    /**
     * Get user home path
     *
     * @return string
     */
    public function getUserHomePath()
    {
        return getenv("HOME");
    }

    /**
     * Create a directory
     *
     * @param string $path Full directory path
     *
     * @return bool
     */
    public function createDirectory($path)
    {
        try{
            (new Filesystem())->mkdir($path);
        }catch(IOException $ex){
            return false; //failure
        }
        return true;
    }

    public function appendTextToFile($text,$path)
    {

    }

}