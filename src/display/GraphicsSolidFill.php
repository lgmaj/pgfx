<?php

namespace pgfx\display;

class GraphicsSolidFill implements IGraphicsFill, IGraphicsData
{
    public function __construct(public int $color)
    {
    }
}