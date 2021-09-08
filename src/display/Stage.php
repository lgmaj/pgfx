<?php

namespace pgfx\display;

abstract class Stage
{
    public Graphics $graphics;

    protected int $wight;
    protected int $height;

    public function __construct()
    {
        $this->graphics = new Graphics();
    }

    abstract function onAddedToStage(): void;

    abstract function onEnterFrame(): void;

    public function setWight(int $wight): void
    {
        $this->wight = $wight;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }
}