<?php

namespace pgfx\utils;

class ByteArray implements IDataInput, IDataOutput {
    public string $bytes;
    public int $position;

    public function __construct()
    {
        $this->bytes = "";
        $this->position = 0;
    }

    public function readByte(): int
    {
        return ord($this->bytes[$this->position++]);
    }

    public function writeByte($value): void
    {
        $this->bytes .= pack('c', $value);
    }
}