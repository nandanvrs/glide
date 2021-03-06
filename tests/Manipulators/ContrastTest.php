<?php

namespace League\Glide\Manipulators;

use League\Glide\Factories\Request;
use Mockery;

class ContrastTest extends \PHPUnit_Framework_TestCase
{
    private $manipulator;

    public function setUp()
    {
        $this->manipulator = new Contrast();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('League\Glide\Manipulators\Contrast', $this->manipulator);
    }

    public function testRun()
    {
        $image = Mockery::mock('Intervention\Image\Image', function ($mock) {
            $mock->shouldReceive('contrast')->with('50')->once();
        });

        $this->assertInstanceOf(
            'Intervention\Image\Image',
            $this->manipulator->run(Request::create('image.jpg', ['con' => '50']), $image)
        );
    }

    public function testGetPixelate()
    {
        $this->assertEquals('50', $this->manipulator->getContrast('50'));
        $this->assertEquals(false, $this->manipulator->getContrast(null));
        $this->assertEquals(false, $this->manipulator->getContrast('101'));
        $this->assertEquals(false, $this->manipulator->getContrast('-101'));
        $this->assertEquals(false, $this->manipulator->getContrast('a'));
    }
}
