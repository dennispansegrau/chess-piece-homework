<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Class Knight
 * @package App\Services
 */
class Knight extends ChessPiece
{
    public function __toString(): string
    {
        return 'Knight';
    }
}
