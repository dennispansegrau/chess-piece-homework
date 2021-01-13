<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Services\Board;
use App\Services\BoardPosition;

interface ChessRulesInterface
{
    public function isValidMove(
        Board $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool;
}
