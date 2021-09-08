<?php

namespace pgfx\renderer\gd;

class GdImageColorPool
{
    /** @var array<int, int> */
    private array $pool = [];

    function getColor(\GdImage $img, $color): int
    {
        if (!isset($this->pool[$color])) {
            $this->pool[$color] = $this->createColor($img, $color);
        }

        return $this->pool[$color];
    }

    private function createColor(\GdImage $img, int $color): int
    {
        return imagecolorallocate(
            $img,
            ($color >> 16) & 0xff,
            ($color >> 8) & 0xff,
            $color & 0xff
        );
    }
}