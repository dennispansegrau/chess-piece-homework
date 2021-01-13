<?php
declare(strict_types=1);

namespace App\Contracts;

interface BoardPositionInterface
{
    public function getRow(): int;
    public function getColumn(): string;
}
