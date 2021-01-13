<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\King;

/**
 * Validates that the king can move there. Does not consider castling.
 *
 * Class KingMovesRule
 * @package App\ChessRules
 */
class IsValidKingMoveRule implements ChessRulesInterface
{
    public function isValidMove(
        BoardInterface $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {
        if (get_class($chessPiece) !== King::class) {
            return true;
        }

        return !(
            abs($currentBoardPosition->getRow() - $possibleNewBoardPosition->getRow()) > 1 ||
            abs(ord($currentBoardPosition->getColumn()) - ord($possibleNewBoardPosition->getColumn())) > 1
        );
    }
}
