<?php

namespace pgfx\display;

use PHPUnit\Framework\TestCase;

class GraphicsTest extends TestCase
{
    public function testShouldCreatePhatData()
    {
        $g = new Graphics();
        $g->lineStyle(null, 0x00ffff);
        $g->moveTo(10, 10);
        $g->lineTo(100, 10);
        $g->lineTo(100, 100);
        $g->lineTo(10, 100);
        $g->lineTo(10, 10);

        self::assertEquals(
            [
                [0, 0x00ffff],
                [1, 10, 10, 100, 10],
                [1, 100, 10, 100, 100],
                [1, 100, 100, 10, 100],
                [1, 10, 100, 10, 10]
            ],
            $g->readGraphicsData()
        );
    }
}