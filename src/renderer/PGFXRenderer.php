<?php

namespace pgfx\renderer;

use pgfx\display\Graphics;
use pgfx\display\Stage;

interface PGFXRenderer
{
    function render(Graphics $graphics): void;

    function renderStage(Stage $stage): void;
}