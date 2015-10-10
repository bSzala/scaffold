<?php
use Fenix440\Scaffold\Helpers\TemplateHelper;

/**
 * Class TemplateHelperTest
 *
 * @coversDefaultClass Fenix440\Scaffold\Helpers\TemplateHelper
 * @author Bartlomiej Szala <fenix440@gmail.com>
 */
class TemplateHelperTest extends \Codeception\TestCase\Test
{
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
     * Dummy data
     * @return array
     */
    public function textProvider()
    {
        return [
                ['text_A','Text A'],
                ['text_BC','Text BC'],
                ['text_BC_D','Text BC D'],
                ['text_BC_D e','Text BC D e'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider textProvider
     *
     * @covers  ::prettyName
     *
     * @param string $text
     * @param string $correctText
     */
    public function testReplaceAndCapitalizeMethods($text,$correctText)
    {
        $this->assertEquals(TemplateHelper::prettyName($text),$correctText,sprintf('%s is not formatted correctly.',$text));
    }
}