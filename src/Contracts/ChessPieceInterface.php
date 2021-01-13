<?php
declare(strict_types=1);

namespace App\Contracts;

/**
 * Interface ChessPieceInterface
 * @package App\Contracts
 */
interface ChessPieceInterface
{
    /**
     * @return string
     */
    public function getColor(): string;
}
