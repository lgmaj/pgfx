<?php

namespace pgfx\geom;

class Point
{
    public function __construct(public float $x = 0,
                                public float $y = 0)
    {
    }

    public function setTo(float $x, float $y): void
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function add(Point $v): Point
    {
        return new Point($this->x + $v->x, $this->y + $v->y);
    }

    public function subtract(Point $v): Point
    {
        return new Point($this->x - $v->x, $this->y - $v->y);
    }
}