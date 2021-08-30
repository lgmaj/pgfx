<?php

namespace pgfx\renderer\gd;

use pgfx\display\Graphics;
use pgfx\renderer\PGFXRenderer;

class GdImageRenderer implements PGFXRenderer
{
    private int $quality;
    private GdImageColorPool $colorPool;

    public function __construct(private int $wight,
                                private int $height,
                                private int $bg = 0xffffff)
    {
        $this->quality = 100;
        $this->colorPool = new GdImageColorPool();
    }

    public function setBackgroundColor($value): void
    {
        $this->bg = $value;
    }

    public function setQuality($value): void
    {
        $this->quality = $value;
    }

    public function render(Graphics $graphics): void
    {
        header("Content-type: image/jpeg");
        $img = imagecreate($this->wight, $this->height);
        $color = $this->createColor($img, $this->bg);
        foreach ($graphics->readGraphicsData() as $command) {
            if ($command[0] == 0) {
                $color = $this->createColor($img, $command[1]);
            }
            if ($command[0] == 1) {
                imageline($img, $command[1], $command[2], $command[3], $command[4], $color);
            }
        }
        imagejpeg($img, null, $this->quality);
        imagedestroy($img);
    }

    private function createColor(\GdImage $img, int $color): int
    {
        return $this->colorPool->getColor($img, $color);
    }
}