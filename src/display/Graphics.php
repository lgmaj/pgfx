<?php

namespace pgfx\display;

final class Graphics
{
    private array $graphicsData = [];
    private GraphicsPath|null $fillPath = null;
    private GraphicsPath|null $linePath = null;

    public function beginFill(int $color = 0): void
    {
        $this->fillPath = new GraphicsPath();
        array_push(
            $this->graphicsData,
            new GraphicsSolidFill($color),
            $this->fillPath
        );
    }

    public function endFill(): void
    {
        array_push($this->graphicsData, new GraphicsEndFill());
        $this->fillPath = null;
        $this->linePath = null;
    }

    public function lineStyle($thickness = null, int $color = 0): void
    {
        $this->linePath = new GraphicsPath();
        array_push(
            $this->graphicsData,
            new GraphicsStroke(new GraphicsSolidFill($color)),
            $this->linePath
        );
    }

    function lineTo(float $x, float $y): void
    {
        $this->fillPath?->lineTo($x, $y);
        $this->linePath?->lineTo($x, $y);
    }

    function moveTo(float $x, float $y): void
    {
        $this->fillPath?->moveTo($x, $y);
        $this->linePath?->moveTo($x, $y);
    }

    function readGraphicsData(): array
    {
        return $this->graphicsData;
    }
}