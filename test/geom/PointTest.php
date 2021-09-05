<?php

namespace pgfx\geom;

use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{

    public function testShouldAddPoint(): void
    {
        $p1 = new Point(4, 8);
        $p2 = new Point(1, 2);

        self::assertEquals(new Point(5, 10), $p1->add($p2));
    }

    public function testShouldSubtractPoint(): void
    {
        $p1 = new Point(4, 8);
        $p2 = new Point(1, 2);

        self::assertEquals(new Point(3, 6), $p1->subtract($p2));
    }
}