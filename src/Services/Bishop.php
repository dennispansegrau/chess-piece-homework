<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Class Bishop
 * @package App\Services
 */
class Bishop extends ChessPiece
{
    public function __toString(): string
    {
        return 'Bishop';
    }
}
