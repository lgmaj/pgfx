<?php

namespace pgfx\display;

class GraphicsDrawRect implements IGraphicsData
{
    public function __construct(public float $x,
                                public float $y,
                                public float $width,
                                public float $height)
    {
    }
}