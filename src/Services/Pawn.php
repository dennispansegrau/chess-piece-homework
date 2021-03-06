<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Class Pawn
 * @package App\Services
 */
class Pawn extends ChessPiece
{
    public function __toString(): string
    {
        return 'Pawn';
    }
}
