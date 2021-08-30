<?php

namespace pgfx\renderer;

use pgfx\display\Graphics;

interface PGFXRenderer
{
    function render(Graphics $graphics): void;
}