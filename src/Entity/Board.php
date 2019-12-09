<?php

declare(strict_types=1);

namespace Dominoes\Entity;

interface Board
{
    public function startBoard(): self;

    public function play(): void;
}
