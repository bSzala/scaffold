<?php namespace BSzala\Scaffold\Commands;
use BSzala\Scaffold\Helpers\PathHelper;
use BSzala\Scaffold\Helpers\TemplateHelper;
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
 * A command for creating templates in given target destination
 *
 * @package BSzala\Scaffold\Commands
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
        $templateList = $this->getTemplatesList($this->findTemplates());
        $prettyTemplateList = $this->formatTemplatesList($templateList);
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'What kind of template, You would like to create?',
                $prettyTemplateList
        );
        $question->setErrorMessage('Template %s is invalid');
        $selectedTemplate = $helper->ask($input,$output,$question);

        // find a key for selected template
        $key = array_search($selectedTemplate,$prettyTemplateList);
        $templateDirectoryName = $templateList[$key];

        $targetPath = $input->getArgument(self::ARGUMENT_PATH_NAME);

        $this->createTemplate($templateDirectoryName,$targetPath);
        $output->writeln(sprintf('<comment>%s</comment> created into <info>%s</info>',$selectedTemplate,$targetPath));
    }

    /**
     * Find available templates
     *
     * @return Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
    protected function findTemplates()
    {
        $finder = new Finder();
        return $finder->directories()->in(PathHelper::getTemplatesPath())->depth(0);

    }

    /**
     * Get template list
     *
     * @param Finder $directoryList A finder directory list
     * @return array A list of available template names
     */
    protected function getTemplatesList(Finder $directoryList)
    {
        $list=[];
        foreach($directoryList as $directory){
            /** @var \Symfony\Component\Finder\SplFileInfo $directory  */
            $list[] = $directory->getFilename();
        }
        return $list;
    }

    /**
     * Format template list
     *
     * @param array $list
     * @return array
     */
    protected function formatTemplatesList(array $list)
    {
        return array_map(function($name){
            return TemplateHelper::prettyName($name);
        },$list);
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

 