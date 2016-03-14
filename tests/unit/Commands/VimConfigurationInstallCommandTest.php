<?php
use BSzala\Scaffold\Commands\VimConfigurationInstallCommand;
use Codeception\Configuration;
use Codeception\Util\Debug;
use Ofbeaton\Console\Tester\QuestionTester;
use Ofbeaton\Console\Tester\UnhandledQuestionException;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Finder\Finder;

/**
 * Class VimConfigurationInstallCommandTest
 *
 * @coversDefaultClass \BSzala\Scaffold\Commands\VimConfigurationInstallCommand
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class VimConfigurationInstallCommandTest extends \Codeception\TestCase\Test
{
    use QuestionTester;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * Get command to be tested
     *
     * @return \Symfony\Component\Console\Command\Command
     */
    protected function getCommand()
    {
        $application = new \Symfony\Component\Console\Application('testing','testing');
        $command = $application->add(new VimConfigurationInstallCommand());

        return $command;
    }

    /**
     * Clean up a folder - delete it!
     *
     * @param string $target Path to target folder to be removed
     */
    protected function cleanupFolder($target)
    {
        $files = glob($target . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->cleanupFolder($file) : @unlink($file);
        }
        @rmdir($target);
        return;
    }


    // =======================================================================//
    // Actual tests
    // =======================================================================//

    /**
     * @test
     *
     * @throws \Codeception\Exception\ConfigurationException
     */
    public function hasInstalledVimConfigurationInTargetDirectory()
    {
        $target = Configuration::outputDir().'vimConfigTest';
        $this->cleanupFolder($target);


        Debug::debug('<info>Preparing command...</info>');

        $command = $this->getCommand();

        Debug::debug('<info>Preparing question helper...</info>');
        $this->mockQuestionHelper($command,function($test,$order, ConfirmationQuestion $question){
        // Pick the first choice
        if($order == 0){
            return true;
        }
        throw new UnhandledQuestionException();
    });

        Debug::debug('<info>Executing...</info>');
        $tester=new \Symfony\Component\Console\Tester\CommandTester($command);
        $tester->execute([
            VimConfigurationInstallCommand::TARGET_DIR_ARGUMENT => $target
        ]);
        $output = $tester->getDisplay();

        Debug::debug($output);

        $finder = new Finder();
        $count = $finder->directories()->ignoreDotFiles(false)->in($target)->count();
        $this->assertNotEquals(0,$count,'No files have been copied!');
    }
}