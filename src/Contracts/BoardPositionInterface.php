<?php
declare(strict_types=1);

namespace App\Contracts;

/**
 * Interface BoardPositionInterface
 * @package App\Contracts
 */
interface BoardPositionInterface
{
    /**
     * @return int
     */
    public function getRow(): int;

    /**
     * @return string
     */
    public function getColumn(): string;

    /**
     * @return int
     */
    public function getColumnAsInt(): int;

    /**
     * @param BoardPositionInterface $otherPosition
     * @return bool
     */
    public function isDiagonally(BoardPositionInterface $otherPosition): bool;

    /**
     * @param BoardPositionInterface $otherPosition
     * @return bool
     */
    public function isHorizontally(BoardPositionInterface $otherPosition): bool;

    /**
     * @param BoardPositionInterface $otherPosition
     * @return bool
     */
    public function isVertically(BoardPositionInterface $otherPosition): bool;
}
