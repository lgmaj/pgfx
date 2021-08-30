<?php

namespace pgfx\display;

use pgfx\geom\Point;

final class Graphics
{
    private array $commands = [];
    private Point $position;

    public function __construct()
    {
        $this->position = new Point();
    }

    public function lineStyle($thickness = null, int $color = 0): void
    {
        $this->commands[] = [0, $color];
    }

    function lineTo(float $x, float $y): void
    {
        $this->commands[] = [1, $this->position->x, $this->position->y, $x, $y];
        $this->moveTo($x, $y);
    }

    function moveTo(float $x, float $y): void
    {
        $this->position->setTo($x, $y);
    }

    function readGraphicsData(): array
    {
        return $this->commands;
    }
}