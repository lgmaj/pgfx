<?php

namespace pgfx\utils;

interface IDataOutput
{
    function writeByte($value): void;
}