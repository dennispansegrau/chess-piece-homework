<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\ChessPieceInterface;

abstract class ChessPiece implements ChessPieceInterface
{
    private string $color;

    /**
     * ChessPiece constructor.
     * @param string $color
     */
    public function __construct(string $color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }
}
