<?php

declare(strict_types=1);

namespace Dominoes\Writer;

final class ConsoleWriter implements Writer
{
    public function write(string $content): void
    {
        echo $content . PHP_EOL;
    }
}
