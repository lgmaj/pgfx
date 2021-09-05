<?php

namespace pgfx\attribute;

use Attribute;

#[Attribute]
class PGFX
{
    public function __construct(public int $frameCount = 25,
                                public int $frameRate = 5,
                                public int $wight = 320,
                                public int $height = 240,
                                public int $loop = 0)
    {
    }
}