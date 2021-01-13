<?php
declare(strict_types=1);

namespace App\Factories;

use App\Contracts\ChessPieceInterface;
use App\Services\Bishop;
use App\Services\King;
use App\Services\Knight;
use App\Services\Pawn;
use App\Services\Queen;
use App\Services\Rook;
use \InvalidArgumentException;

/**
 * Class ChessPieceFactory
 * @package App\Factories
 */
class ChessPieceFactory
{
    /**
     * @param string $name
     * @param string $chessPieceColorInput
     * @return ChessPieceInterface
     */
    public static function createChessPiece(string $name, string $chessPieceColorInput): ChessPieceInterface
    {
        switch (strtoupper($name)) {
            case 'K':
                return new King($chessPieceColorInput);
            case 'Q':
                return new Queen($chessPieceColorInput);
            case 'R':
                return new Rook($chessPieceColorInput);
            case 'B':
                return new Bishop($chessPieceColorInput);
            case 'N':
                return new Knight($chessPieceColorInput);
            case 'P':
                return new Pawn($chessPieceColorInput);
            default:
                throw new InvalidArgumentException("$name is not a valid Chess Piece! Please use K, Q, R, B, N or P");
        }
    }
}
