<?php

namespace pgfx\display;

class GraphicsPath implements IGraphicsFill, IGraphicsData
{
    public function __construct(public array $commands = [],
                                public array $data = [])
    {
    }

    function lineTo(float $x, float $y): void
    {
        $this->commands[] = 2;
        $this->data[] = $x;
        $this->data[] = $y;
    }

    function moveTo(float $x, float $y): void
    {
        $this->commands[] = 1;
        $this->data[] = $x;
        $this->data[] = $y;
    }
}