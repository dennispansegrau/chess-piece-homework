<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\Rook;

class IsValidRookMoveRule implements ChessRulesInterface
{

    public function isValidMove(
        BoardInterface $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {
        if (get_class($chessPiece) !== Rook::class) {
            return true;
        }

        return $currentBoardPosition->isHorizontally($possibleNewBoardPosition) ||
            $currentBoardPosition->isVertically($possibleNewBoardPosition);
    }
}
