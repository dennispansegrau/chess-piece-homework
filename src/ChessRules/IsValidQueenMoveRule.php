<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\Queen;

class IsValidQueenMoveRule implements ChessRulesInterface
{
    public function isValidMove(
        BoardInterface $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {
        if (get_class($chessPiece) !== Queen::class) {
            return true;
        }

        return $currentBoardPosition->isDiagonally($possibleNewBoardPosition) ||
            $currentBoardPosition->isHorizontally($possibleNewBoardPosition) ||
            $currentBoardPosition->isVertically($possibleNewBoardPosition);
    }
}
