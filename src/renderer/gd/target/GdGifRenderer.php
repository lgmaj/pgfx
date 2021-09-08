<?php

namespace pgfx\renderer\gd\target;

use GdImage;

class GdGifRenderer implements GdImageRendererTarget
{
    public function render(GdImage $img): void
    {
        header("Content-type: image/gif");
        imagegif($img);
    }
}