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

    public function clear(): void
    {
        $this->graphicsData = [];
        $this->fillPath = null;
        $this->linePath = null;
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

    public function lineTo(float $x, float $y): void
    {
        $this->fillPath?->lineTo($x, $y);
        $this->linePath?->lineTo($x, $y);
    }

    public function moveTo(float $x, float $y): void
    {
        $this->fillPath?->moveTo($x, $y);
        $this->linePath?->moveTo($x, $y);
    }

    public function drawCircle(float $x, float $y, float $radius): void
    {
        array_push($this->graphicsData, new GraphicsDrawCircle(
            $x, $y, $radius
        ));
    }

    public function drawRect(float $x, float $y, float $width, float $height): void
    {
        array_push($this->graphicsData, new GraphicsDrawRect(
            $x, $y, $width, $height
        ));
    }

    function readGraphicsData(): array
    {
        return $this->graphicsData;
    }
}