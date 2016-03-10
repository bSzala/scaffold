<?php
use BSzala\Scaffold\Helpers\TextHelper;

/**
 * Class TextHelperTest
 *
 * @coversDefaultClass BSzala\Scaffold\Helpers\TextHelper
 * @author Bartlomiej Szala <fenix440@gmail.com>
 */
class TextHelperTest extends \Codeception\TestCase\Test
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
            ['text A','TextA'],
            ['text BC','TextBC'],
            ['text BC D','TextBCD'],
            ['text BC D e','TextBCDe'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider textProvider
     *
     * @covers  ::capitalize
     * @covers  ::replace
     *
     * @param string $text
     * @param string $correctText
     */
    public function testReplaceAndCapitalizeMethods($text,$correctText)
    {
        $this->assertEquals(TextHelper::capitalize(TextHelper::replace(' ','',$text)),$correctText,sprintf('%s is not translated correctly.',$text));
    }
}