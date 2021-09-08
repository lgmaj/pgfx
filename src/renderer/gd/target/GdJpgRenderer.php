<?php

namespace pgfx\renderer\gd\target;

use GdImage;

class GdJpgRenderer implements GdImageRendererTarget
{
    public function __construct(private int $quality)
    {
    }

    public function render(GdImage $img): void
    {
        header("Content-type: image/jpeg");
        imagejpeg($img, null, $this->quality);
    }
}