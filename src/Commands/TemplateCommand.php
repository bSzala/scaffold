<?php namespace Fenix440\Scaffold\Commands;
use Fenix440\Scaffold\Helpers\PathHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class TemplateCommand
 *
 * A command for creating templates in given destination path
 *
 * @package Fenix440\Scaffold\Commands
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class TemplateCommand extends Command
{
    /**
     * Command name
     */
    const COMMAND_NAME = 'template';

    /**
     * Argument PATH name
     */
    const ARGUMENT_PATH_NAME = 'path';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
                ->setName(self::COMMAND_NAME)
                ->setDescription("Creates scaffold template for a selected type")
                ->addArgument(
                        self::ARGUMENT_PATH_NAME,
                        InputArgument::OPTIONAL,
                        'Specify a path, where template should be installed',
                        getcwd()
                );

    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //@todo Fetch awailable template list
        $templateList = $this->formatTemplateList($this->getTemplateList());
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'What kind of template, You would like to install?',
                $templateList
        );
        $question->setErrorMessage('Template %s is invalid');
        $selectedTemplate = $helper->ask($input,$output,$question);

        $targetPath = $input->getArgument(self::ARGUMENT_PATH_NAME);

        $this->createTemplate($selectedTemplate,$targetPath);
        $output->writeln(sprintf('<comment>%s</comment> created into <info>%s</info>',$selectedTemplate,$targetPath));
    }

    /**
     *
     * @return Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
    protected function getTemplateList()
    {
        $finder = new Finder();
        return $finder->directories()->in(PathHelper::getTemplatesPath())->depth(0);

    }

    /**
     * Formats template list
     *
     * @param Finder $directoryList A finder directory list
     * @return array A list of available template names
     */
    protected function formatTemplateList(Finder $directoryList)
    {
        $list=[];
        foreach($directoryList as $directory){
            /** @var \Symfony\Component\Finder\SplFileInfo $directory  */
            $list[] = $directory->getFilename();
        }
        return $list;
    }

    /**
     * Creates a template on given target path
     *
     * @param string $templateName Template name
     * @param string $targetPath Target full path
     */
    protected function createTemplate($templateName,$targetPath)
    {
        $templatePath = PathHelper::getTemplatesPath().'/'.$templateName;

        $fs = new Filesystem();
        $fs->mirror($templatePath,$targetPath);
    }
}

 