<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Class Queen
 * @package App\Services
 */
class Queen extends ChessPiece
{
    public function __toString(): string
    {
        return 'Queen';
    }
}
