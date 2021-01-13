<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\ChessPiece;
use App\Services\Pawn;

/**
 * Does not consider capturing diagonally.
 *
 * Class IsValidPawnsMoveRule
 * @package App\ChessRules
 */
class IsValidPawnsMoveRule implements ChessRulesInterface
{
    public function isValidMove(
        BoardInterface $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {
        if (get_class($chessPiece) !== Pawn::class) {
            return true;
        }

        $color = $chessPiece->getColor();

        if ($color === ChessPiece::BLACK && $currentBoardPosition->getRow() < $possibleNewBoardPosition->getRow()) {
            return false;
        }

        if ($color === ChessPiece::WHITE && $currentBoardPosition->getRow() > $possibleNewBoardPosition->getRow()) {
            return false;
        }

        if ($currentBoardPosition->getColumn() !== $possibleNewBoardPosition->getColumn()) {
            return false;
        }

        $rowDistance = abs($currentBoardPosition->getRow() - $possibleNewBoardPosition->getRow());

        if ($rowDistance > 2) {
            return false;
        }

        if ($color === ChessPiece::BLACK && $rowDistance === 2 && $currentBoardPosition->getRow() !== 7) {
            return false;
        }

        if ($color === ChessPiece::WHITE && $rowDistance === 2 && $currentBoardPosition->getRow() !== 2) {
            return false;
        }

        return true;
    }
}
