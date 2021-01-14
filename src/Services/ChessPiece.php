<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\ChessPieceInterface;
use InvalidArgumentException;

/**
 * Class ChessPiece
 * @package App\Services
 */
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
        if ($color !== self::WHITE && $color !== self::BLACK) {
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

    abstract public function __toString(): string;
}
