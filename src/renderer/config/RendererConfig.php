<?php

namespace pgfx\renderer\config;

class RendererConfig
{
    public function __construct(public int $frameCount = 25,
                                public int $frameRate = 5,
                                public int $wight = 320,
                                public int $height = 240,
                                public int $loop = 0)
    {
    }

    public function read(array $properties): void
    {
        $this->readProperty('frameCount', $properties, 1);
        $this->readProperty('frameRate', $properties, 1);
        $this->readProperty('wight', $properties, 1);
        $this->readProperty('height', $properties, 1);
        $this->readProperty('loop', $properties, 0);
    }

    private function readProperty(string $key, array $properties, int $min): void
    {
        if (array_key_exists($key, $properties)) {
            $value = $properties[$key];
            if ($value >= $min) {
                $this->{$key} = $value;
            }
        }
    }
}