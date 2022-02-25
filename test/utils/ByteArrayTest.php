<?php

namespace pgfx\utils;

use PHPUnit\Framework\TestCase;

class ByteArrayTest extends TestCase
{
    public function test_byte_io(): void
    {
        $ba = new ByteArray();

        $ba->writeByte(0);
        $ba->writeByte(1);
        $ba->writeByte(2);
        $ba->writeByte(3);


        $this->assertEquals(0, $ba->position);

        $this->assertEquals(0, $ba->readByte());
        $this->assertEquals(1, $ba->readByte());
        $this->assertEquals(2, $ba->readByte());
        $this->assertEquals(3, $ba->readByte());

        $ba->position = 2;


        $this->assertEquals(2, $ba->position);

        $this->assertEquals(2, $ba->readByte());
        $this->assertEquals(3, $ba->readByte());
    }
}