<?php

namespace pgfx\renderer\gd;

use pgfx\display\Graphics;
use pgfx\display\GraphicsPath;
use pgfx\display\GraphicsSolidFill;
use pgfx\display\GraphicsStroke;
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
        $fill = false;

        foreach ($graphics->readGraphicsData() as $data) {
            if ($data instanceof GraphicsStroke) {
                $color = $this->createColor($img, $data->fill->color);
                $fill = false;
            }
            if ($data instanceof GraphicsSolidFill) {
                $color = $this->createColor($img, $data->color);
                $fill = true;
            }
            if ($data instanceof GraphicsPath) {
                if ($fill) {
                    imagefilledpolygon($img, $data->data, count($data->commands), $color);
                } else {
                    imagepolygon($img, $data->data, count($data->commands), $color);
                }
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