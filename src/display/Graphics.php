<?php

namespace pgfx\display;

final class Graphics
{
    private array $graphicsData = [];
    private int $fillColor = -1;
    private int $strokeColor = -1;
    private GraphicsPath|null $fillPath = null;
    private GraphicsPath|null $linePath = null;

    public function beginFill(int $color = 0): void
    {
        $this->fillColor = $color;
        $this->fillPath = new GraphicsPath();
        array_push(
            $this->graphicsData,
            new GraphicsSolidFill($color),
            $this->fillPath,
            new GraphicsEndFill()
        );
    }

    public function clear(): void
    {
        $this->graphicsData = [];
        $this->fillPath = null;
        $this->linePath = null;
        $this->endFill();
    }

    public function endFill(): void
    {
        $this->fillColor = -1;
        $this->strokeColor = -1;
        $this->fillPath = null;
        $this->linePath = null;
    }

    public function lineStyle($thickness = null, int $color = 0): void
    {
        $this->strokeColor = $color;
        $this->linePath = new GraphicsPath();
        array_push(
            $this->graphicsData,
            new GraphicsStroke(new GraphicsSolidFill($color)),
            $this->linePath,
            new GraphicsEndFill()
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
        $this->addColorCommands();
        array_push($this->graphicsData,
            new GraphicsDrawCircle($x, $y, $radius),
            new GraphicsEndFill()
        );
    }

    public function drawRect(float $x, float $y, float $width, float $height): void
    {
        $this->addColorCommands();
        array_push(
            $this->graphicsData,
            new GraphicsDrawRect($x, $y, $width, $height),
            new GraphicsEndFill()
        );
    }

    private function addColorCommands(): void
    {
        if ($this->fillColor > -1) {
            array_push($this->graphicsData, new GraphicsSolidFill($this->fillColor));
        }
        if ($this->strokeColor > -1) {
            array_push($this->graphicsData, new GraphicsStroke(new GraphicsSolidFill($this->strokeColor)));
        }
    }

    public function readGraphicsData(): array
    {
        return $this->graphicsData;
    }
}