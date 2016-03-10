<?php
use BSzala\Scaffold\Helpers\PathHelper;

/**
 * Class PathHelperTest
 *
 * @coversDefaultClass BSzala\Scaffold\Helpers\PathHelper
 * @author Bartlomiej Szala <fenix440@gmail.com>
 */
class PathHelperTest extends \Codeception\TestCase\Test
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
     * @test
     *
     * @covers  ::getBasePath
     * @covers  ::getTemplatesPath
     *
     * @return array
     */
    public function pathProvider()
    {
        return [
            [PathHelper::getBasePath(),'Base Path'],
            [PathHelper::getTemplatesPath(),'Template Path']
        ];
    }

    // =======================================================================//
    // ACTUAL TESTS
    // =======================================================================//

    /**
     * @test
     * @dataProvider pathProvider
     *
     * @covers  ::getBasePath
     * @covers  ::getTemplatesPath
     *
     * @param string $path
     * @param string $name
     */
    public function doesPathExists($path, $name)
    {
        $this->assertTrue(file_exists($path),sprintf('%s (%s) does not exist or is not accessible',$name,$path));
    }
}