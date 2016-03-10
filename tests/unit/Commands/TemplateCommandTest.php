<?php
use Codeception\Configuration;
use Codeception\Util\Debug;
use BSzala\Scaffold\Commands\TemplateCommand;
use Ofbeaton\Console\Tester\QuestionTester;
use Ofbeaton\Console\Tester\UnhandledQuestionException;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Finder\Finder;

/**
 * Class TemplateCommandTest
 *
 * @coversDefaultClass BSzala\Scaffold\Commands\TemplateCommand
 * @author Bartlomiej Szala <fenix440@gmail.com>
 */
class TemplateCommandTest extends \Codeception\TestCase\Test
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

    /**
     * Get command to be tested
     *
     * @return \Symfony\Component\Console\Command\Command
     */
    protected function getCommand()
    {
        $application = new \Symfony\Component\Console\Application('testing','testing');
        $command = $application->add(new TemplateCommand());

        return $command;
    }

    // =======================================================================//
    // Actual tests
    // =======================================================================//

    /**
     * @test
     *
     * @covers  ::execute
     * @covers  ::configure
     * @covers  ::findTemplates
     * @covers  ::getTemplatesList
     * @covers  ::formatTemplatesList
     * @covers  ::createTemplate
     */
    public function hasCopiedFilesIntoTargetLocation()
    {
        $target = Configuration::outputDir().'tmp';

        // Eventual pre-cleanup
        $this->cleanupFolder($target);

        Debug::debug('<info>Preparing command...</info>');

        $command = $this->getCommand();

        Debug::debug('<info>Preparing question helper...</info>');

        $this->mockQuestionHelper($command,function($test,$order, Question $question){
            // Pick the first choice
            if($order == 0){
                return true;
            }
            throw new UnhandledQuestionException();
        });

        Debug::debug('<info>Executing...</info>');

        $tester=new \Symfony\Component\Console\Tester\CommandTester($command);
        $tester->execute([
           TemplateCommand::ARGUMENT_PATH_NAME => $target
        ]);
        $output = $tester->getDisplay();

        Debug::debug($output);

        $finder = new Finder();
        $count = $finder->directories()->in($target)->count();
        $this->assertNotEquals(0,$count,'No files have been copied!');
    }
}