<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\Board;

/**
 * Valid that the chess piece was moved.
 *
 * Class SameFieldRule
 * @package App\ChessRules
 */
class IsNotSameFieldRule implements ChessRulesInterface
{
    public function isValidMove(
        Board $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool
    {
        if ($currentBoardPosition == $possibleNewBoardPosition) {
            return false;
        }

        return true;
    }
}
