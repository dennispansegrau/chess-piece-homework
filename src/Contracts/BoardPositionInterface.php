<?php
declare(strict_types=1);

namespace App\Contracts;

interface BoardPositionInterface
{
    public function getRow(): int;
    public function getColumn(): string;
    public function getColumnAsInt(): int;
    public function isDiagonally(BoardPositionInterface $otherPosition): bool;
    public function isHorizontally(BoardPositionInterface $otherPosition): bool;
    public function isVertically(BoardPositionInterface $otherPosition): bool;
}
