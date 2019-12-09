<?php

declare(strict_types=1);

namespace Dominoes\Writer;

interface Writer
{
    public function write(string $content): void;
}
