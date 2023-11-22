<?php

namespace Intervention\Image\Drivers\Imagick\Analyzers;

use Imagick;
use Intervention\Image\Drivers\DriverAnalyzer;
use Intervention\Image\Interfaces\ColorInterface;
use Intervention\Image\Interfaces\ColorspaceInterface;
use Intervention\Image\Interfaces\ImageInterface;

class PixelColorAnalyzer extends DriverAnalyzer
{
    public function analyze(ImageInterface $image): mixed
    {
        return $this->colorAt(
            $image->colorspace(),
            $image->core()->frame($this->frame_key)->native()
        );
    }

    protected function colorAt(ColorspaceInterface $colorspace, Imagick $imagick): ColorInterface
    {
        return $this->driver()
            ->colorProcessor($colorspace)
            ->nativeToColor(
                $imagick->getImagePixelColor($this->x, $this->x)
            );
    }
}
