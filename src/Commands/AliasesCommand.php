<?php
namespace BSzala\Scaffold\Commands;
use InvalidArgumentException;

/**
 * Class AliasesCommand
 *
 * @package BSzala\Scaffold\Commands
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
abstract class AliasesCommand extends BaseCommand
{

    /**
     * User aliases path
     *
     * @var string
     */
    protected $userAliasesPath = "";
    /**
     * Default user aliases directory name
     */
    const USER_ALIASES_DIR_NAME = 'aliases';

    /**
     * Get user aliases path
     *
     * @return string
     */
    public function getUserAliasesPath()
    {
        if(!$this->hasUserAliasesPath() && $this->hasDefaultUserAliasesPath())
            $this->setUserAliasesPath($this->getDefaultUserAliasesPath());
        return $this->userAliasesPath;
    }

    /**
     * Set user aliases path
     *
     * @param string $path User aliases path
     *
     * @return void
     * @throws InvalidArgumentException If user aliases path is invalid
     */
    public function setUserAliasesPath($path)
    {
        if(!$this->isUserAliasesPathValid($path))
            throw new InvalidArgumentException(sprintf('User aliases path: "%s" is invalid.',$path));
        $this->userAliasesPath=$path;
    }

    /**
     * Validates if user aliases path is valid
     *
     * @param mixed $path User aliases path to validate
     *
     * @return bool
     */
    public function isUserAliasesPathValid($path)
    {
        return (is_string($path) && !empty($path))?:false;
    }
    /**
     * Checks if user aliases path is set
     * @return bool
     */
    public function hasUserAliasesPath()
    {
        return !empty($this->userAliasesPath)?:false;
    }

    /**
     * Checks if default user aliases path is set
     *
     * @return bool
     */
    public function hasDefaultUserAliasesPath()
    {
        return !empty($this->getDefaultUserAliasesPath())?:false;
    }
    /**
     * Get default user aliases path
     *
     * @return string
     */
    public function getDefaultUserAliasesPath()
    {
        return $this->getUserHomePath().'/'.self::USER_ALIASES_DIR_NAME;
    }

    /**
     * Create user aliases directory
     *
     * @return bool True when directory is created, false otherwise
     */
    public function createUserAliasesDirectory()
    {
        if(!$this->userAliasesDirectoryExist())
           return $this->createDirectory($this->getUserAliasesPath());
        return true;
    }

    /**
     * Get user aliases path
     *
     * @return bool
     */
    public function userAliasesDirectoryExist()
    {
        return file_exists($this->getUserAliasesPath())?:false;
    }
}