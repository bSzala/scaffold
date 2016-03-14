<?php
namespace BSzala\Scaffold\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Filesystem;

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
        $fs = new Filesystem();
        $fs->mirror($sourcePath,$targetPath,null,['override' => $override]);
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
        $fs = new Filesystem();
        return $fs->exists($files);
    }

}