<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\Knight;

/**
 * Class IsValidKnightMoveRule
 * @package App\ChessRules
 */
class IsValidKnightMoveRule implements ChessRulesInterface
{
    /**
     * @param BoardInterface $board
     * @param ChessPieceInterface $chessPiece
     * @param BoardPositionInterface $currentBoardPosition
     * @param BoardPositionInterface $possibleNewBoardPosition
     * @return bool
     */
    public function isValidMove(
        BoardInterface $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {
        if (get_class($chessPiece) !== Knight::class) {
            return true;
        }

        $rowDistance = abs($currentBoardPosition->getRow() - $possibleNewBoardPosition->getRow());
        $columnDistance = abs($currentBoardPosition->getColumnAsInt() - $possibleNewBoardPosition->getColumnAsInt());

        return ($rowDistance === 1 && $columnDistance === 2) || ($rowDistance === 2 && $columnDistance === 1);
    }
}
