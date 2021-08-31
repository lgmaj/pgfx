<?php

namespace pgfx\display;

class GraphicsStroke implements IGraphicsStroke, IGraphicsData
{
    public function __construct(public GraphicsSolidFill $fill)
    {
    }
}