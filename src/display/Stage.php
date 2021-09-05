<?php

namespace pgfx\display;

abstract class Stage
{
    public Graphics $graphics;

    public function __construct()
    {
        $this->graphics = new Graphics();
    }

    abstract function onAddedToStage(): void;

    abstract function onEnterFrame(): void;
}