<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;

class IsNotBlockedByOwnChessPieceRule implements ChessRulesInterface
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
        $chessPieceAtNewPosition = $board->getChessPiece($possibleNewBoardPosition);
        return !($chessPieceAtNewPosition !== null && $chessPieceAtNewPosition->getColor() === $chessPiece->getColor());
    }
}
