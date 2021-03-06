<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Class King
 * @package App\Services
 */
class King extends ChessPiece
{
    public function __toString(): string
    {
        return 'King';
    }
}
