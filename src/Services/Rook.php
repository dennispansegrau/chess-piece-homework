<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Class Rook
 * @package App\Services
 */
class Rook extends ChessPiece
{
    public function __toString(): string
    {
        return 'Rook';
    }
}
