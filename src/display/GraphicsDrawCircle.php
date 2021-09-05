<?php

namespace pgfx\display;

class GraphicsDrawCircle implements IGraphicsData
{
    public function __construct(public float $x,
                                public float $y,
                                public float $radius)
    {
    }
}