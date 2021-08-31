<?php

namespace pgfx\display;

use PHPUnit\Framework\TestCase;

class GraphicsTest extends TestCase
{
    public function testShouldCreateDataGraphicsStroke()
    {
        $g = new Graphics();
        $g->lineStyle(null, 0x00ffff);
        $g->moveTo(10, 10);
        $g->lineTo(100, 10);
        $g->lineTo(100, 100);
        $g->lineTo(10, 100);
        $g->lineTo(10, 10);
        $g->endFill();

        self::assertEquals(
            [
                new GraphicsStroke(new GraphicsSolidFill(0x00ffff)),
                new GraphicsPath(
                    [1, 2, 2, 2, 2],
                    [
                        10, 10,
                        100, 10,
                        100.0, 100.0,
                        10.0, 100.0,
                        10.0, 10.0
                    ]
                ),
                new GraphicsEndFill()
            ],
            $g->readGraphicsData()
        );
    }

    public function testShouldCreateDataGraphicsFill()
    {
        $g = new Graphics();
        $g->beginFill(0x00ffff);
        $g->moveTo(10, 10);
        $g->lineTo(100, 10);
        $g->lineTo(100, 100);
        $g->lineTo(10, 100);
        $g->lineTo(10, 10);
        $g->endFill();

        self::assertEquals(
            [
                new GraphicsSolidFill(0x00ffff),
                new GraphicsPath(
                    [1, 2, 2, 2, 2],
                    [
                        10, 10,
                        100, 10,
                        100.0, 100.0,
                        10.0, 100.0,
                        10.0, 10.0
                    ]
                ),
                new GraphicsEndFill()
            ],
            $g->readGraphicsData()
        );
    }
}