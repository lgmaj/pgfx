<?php

namespace pgfx\utils;

interface IExternalizable
{
    function readExternal(IDataInput $input): void;

    function writeExternal(IDataOutput $output): void;
}