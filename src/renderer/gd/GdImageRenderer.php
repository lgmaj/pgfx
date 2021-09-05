<?php

namespace pgfx\renderer\gd;

use pgfx\attribute\PGFX;
use pgfx\display\Graphics;
use pgfx\display\GraphicsDrawCircle;
use pgfx\display\GraphicsDrawRect;
use pgfx\display\GraphicsEndFill;
use pgfx\display\GraphicsPath;
use pgfx\display\GraphicsSolidFill;
use pgfx\display\GraphicsStroke;
use pgfx\display\Stage;
use pgfx\renderer\config\RendererConfig;
use pgfx\renderer\PGFXRenderer;
use ReflectionClass;
use SyntaxEvolution\GifCreator\GifCreator;

class GdImageRenderer implements PGFXRenderer
{
    private int $quality;

    public function __construct(private int $wight = 320,
                                private int $height = 240,
                                private int $bg = 0xffffff)
    {
        $this->quality = 100;
    }

    public function setBackgroundColor($value): void
    {
        $this->bg = $value;
    }

    public function setQuality($value): void
    {
        $this->quality = $value;
    }

    public function render(Graphics $graphics): void
    {
        $colorPool = new GdImageColorPool();
        $img = imagecreate($this->wight, $this->height);
        $bg = $colorPool->getColor($img, $this->bg);
        $fillColor = -1;
        $strokeColor = -1;

        foreach ($graphics->readGraphicsData() as $data) {
            if ($data instanceof GraphicsStroke) {
                $strokeColor = $colorPool->getColor($img, $data->fill->color);
            }
            if ($data instanceof GraphicsSolidFill) {
                $fillColor = $colorPool->getColor($img, $data->color);
                $strokeColor = -1;
            }
            if ($data instanceof GraphicsPath) {
                $size = count($data->commands);
                if ($size > 0) {
                    if ($fillColor > -1) {
                        imagefilledpolygon($img, $data->data, $size, $fillColor);
                    } else {
                        imagepolygon($img, $data->data, $size, $strokeColor);
                    }
                }
            }
            if ($data instanceof GraphicsDrawCircle) {
                if ($fillColor > -1) {
                    imagefilledellipse($img, $data->x, $data->y, $data->radius, $data->radius, $fillColor);
                }
                if ($strokeColor > -1) {
                    imageellipse($img, $data->x, $data->y, $data->radius, $data->radius, $strokeColor);
                }
            }
            if ($data instanceof GraphicsDrawRect) {
                if ($fillColor > -1) {
                    imagefilledrectangle($img, $data->x, $data->y, $data->x + $data->width, $data->y + $data->height, $fillColor);
                }
                if ($strokeColor > -1) {
                    imagerectangle($img, $data->x, $data->y, $data->x + $data->width, $data->y + $data->height, $strokeColor);
                }
            }
            if ($data instanceof GraphicsEndFill) {
                $fillColor = -1;
                $strokeColor = -1;
            }
        }

        header("Content-type: image/jpeg");
        imagejpeg($img, null, $this->quality);
        imagedestroy($img);
    }

    public function renderStage(Stage $stage): void
    {
        $config = $this->getConfig(new ReflectionClass($stage::class));

        $this->wight = $config->wight;
        $this->height = $config->height;

        $stage->onAddedToStage();

        $frame = 0;
        $frames = [];

        while ($frame < $config->frameCount) {
            $stage->onEnterFrame();

            ob_start();
            $this->render($stage->graphics);
            array_push($frames, ob_get_contents());
            ob_end_clean();

            $stage->graphics->clear();
            $frame++;
        }

        $gc = new GifCreator();
        $gc->create($frames, array_fill(0, count($frames), $config->frameRate), $config->loop);
        $gif = $gc->getGif();

        header('Content-type: image/gif');
        echo $gif;
    }

    private function getConfig(ReflectionClass $reflection): RendererConfig
    {
        $config = new RendererConfig();
        $config->wight = $this->wight;
        $config->height = $this->height;

        foreach ($reflection->getAttributes(PGFX::class) as $attribute) {
            if ($attribute->getName() == PGFX::class) {
                $config->read($attribute->getArguments());
            }
        }

        return $config;
    }
}