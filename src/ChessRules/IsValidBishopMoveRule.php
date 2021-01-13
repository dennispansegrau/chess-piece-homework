<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\Bishop;
use App\Services\Board;

class IsValidBishopMoveRule implements ChessRulesInterface
{
    public function isValidMove(
        Board $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {
        if (get_class($chessPiece) !== Bishop::class) {
            return true;
        }

        return $currentBoardPosition->isDiagonally($possibleNewBoardPosition);
    }
}
