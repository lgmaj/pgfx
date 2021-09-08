<?php

namespace pgfx\renderer\gd\target;

use GdImage;

interface GdImageRendererTarget
{
    function render(GdImage $img): void;
}