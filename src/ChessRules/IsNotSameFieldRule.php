<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;

/**
 * Valid that the chess piece was moved.
 *
 * Class SameFieldRule
 * @package App\ChessRules
 */
class IsNotSameFieldRule implements ChessRulesInterface
{
    public function isValidMove(
        BoardInterface $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {
        return $currentBoardPosition != $possibleNewBoardPosition;
    }
}
