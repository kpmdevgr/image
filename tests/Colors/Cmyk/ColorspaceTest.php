<?php

namespace Intervention\Image\Tests\Colors\Cmyk;

use Intervention\Image\Colors\Cmyk\Channels\Cyan;
use Intervention\Image\Colors\Cmyk\Channels\Key;
use Intervention\Image\Colors\Cmyk\Channels\Magenta;
use Intervention\Image\Colors\Cmyk\Channels\Yellow;
use Intervention\Image\Colors\Cmyk\Color as CmykColor;
use Intervention\Image\Colors\Rgb\Color as RgbColor;
use Intervention\Image\Colors\Hsv\Color as HsvColor;
use Intervention\Image\Colors\Cmyk\Colorspace;
use Intervention\Image\Tests\TestCase;

/**
 * @requires extension gd
 * @covers \Intervention\Image\Colors\Cmyk\Colorspace
 */
class ColorspaceTest extends TestCase
{
    public function testConvertRgbColor(): void
    {
        $colorspace = new Colorspace();
        $result = $colorspace->convertColor(new RgbColor(0, 0, 255));
        $this->assertInstanceOf(CmykColor::class, $result);
        $this->assertEquals(100, $result->channel(Cyan::class)->value());
        $this->assertEquals(100, $result->channel(Magenta::class)->value());
        $this->assertEquals(0, $result->channel(Yellow::class)->value());
        $this->assertEquals(0, $result->channel(Key::class)->value());
    }

    public function testConvertHsvColor(): void
    {
        $colorspace = new Colorspace();
        $result = $colorspace->convertColor(new HsvColor(240, 100, 100));
        $this->assertInstanceOf(CmykColor::class, $result);
        $this->assertEquals(100, $result->channel(Cyan::class)->value());
        $this->assertEquals(100, $result->channel(Magenta::class)->value());
        $this->assertEquals(0, $result->channel(Yellow::class)->value());
        $this->assertEquals(0, $result->channel(Key::class)->value());
    }
}
