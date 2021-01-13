<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\ChessPieceInterface;
use InvalidArgumentException;

abstract class ChessPiece implements ChessPieceInterface
{
    public const WHITE = 'w';
    public const BLACK = 'b';

    private string $color;

    /**
     * ChessPiece constructor.
     * @param string $color
     */
    public function __construct(string $color)
    {
        $color = strtolower($color);
        if ($color !== 'w' && $color !== 'b') {
            throw new InvalidArgumentException("$color is not a valid color!");
        }
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
