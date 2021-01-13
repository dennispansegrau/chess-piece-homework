<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Services\Board;
use App\Services\King;

/**
 * Validates that the king can move there. Does not consider castling.
 *
 * Class KingMovesRule
 * @package App\ChessRules
 */
class KingMovesRule implements \App\Contracts\ChessRulesInterface
{
    public function isValidMove(
        Board $board,
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
