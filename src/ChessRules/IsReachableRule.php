<?php
declare(strict_types=1);

namespace App\ChessRules;

use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use App\Services\Bishop;
use App\Services\BoardPosition;
use App\Services\King;
use App\Services\Knight;
use App\Services\Pawn;
use App\Services\Queen;
use App\Services\Rook;

/**
 * Checks if new position is reachable and the way is not blocked by an other chess piece.
 * Class IsReachableRule
 * @package App\ChessRules
 */
class IsReachableRule implements ChessRulesInterface
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
        if ($chessPiece instanceof King) {
            return true;
        }

        if ($chessPiece instanceof Queen) {
            return !$this->isWayBlocked($board, $currentBoardPosition, $possibleNewBoardPosition);
        }

        if ($chessPiece instanceof Rook) {
            return !$this->isWayBlocked($board, $currentBoardPosition, $possibleNewBoardPosition);
        }

        if ($chessPiece instanceof Bishop) {
            return !$this->isWayBlocked($board, $currentBoardPosition, $possibleNewBoardPosition);
        }

        if ($chessPiece instanceof Knight) {
            return true;
        }

        if ($chessPiece instanceof Pawn) {
            return !$this->isWayBlocked($board, $currentBoardPosition, $possibleNewBoardPosition);
        }

        return true;
    }

    /**
     * @param BoardInterface $board
     * @param BoardPositionInterface $startPosition
     * @param BoardPositionInterface $targetPosition
     * @return bool
     */
    private function isWayBlocked(
        BoardInterface $board,
        BoardPositionInterface $startPosition,
        BoardPositionInterface $targetPosition
    ): bool {
        $fields = $this->getFieldsBetween($startPosition, $targetPosition);

        foreach ($fields as $field) {
            if ($board->getChessPiece($field) !== null) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param BoardPositionInterface $startPosition
     * @param BoardPositionInterface $targetPosition
     * @return array<BoardPositionInterface>
     */
    private function getFieldsBetween(
        BoardPositionInterface $startPosition,
        BoardPositionInterface $targetPosition
    ): array {
        if ($startPosition->getColumn() === $targetPosition->getColumn() &&
            $startPosition->getRow() === $targetPosition->getRow()
        ) {
            return [];
        }

        if ($startPosition->getColumn() !== $targetPosition->getColumn() &&
            $startPosition->getRow() !== $targetPosition->getRow()
        ) {
            return $this->getDiagonallyFieldsBetween($startPosition, $targetPosition);
        }

        if ($startPosition->getColumn() !== $targetPosition->getColumn()) {
            return $this->getHorizontallyFieldsBetween($startPosition, $targetPosition);
        }

        return $this->getVerticallyFieldsBetween($startPosition, $targetPosition);
    }

    /**
     * @param BoardPositionInterface $startPosition
     * @param BoardPositionInterface $targetPosition
     * @return array<BoardPositionInterface>
     * @psalm-suppress StringIncrement
     */
    private function getDiagonallyFieldsBetween(
        BoardPositionInterface $startPosition,
        BoardPositionInterface $targetPosition
    ): array {
        $minRow = min($startPosition->getRow(), $targetPosition->getRow());
        $maxRow = max($startPosition->getRow(), $targetPosition->getRow());
        /** @var string $column */
        $column = min($startPosition->getColumn(), $targetPosition->getColumn());

        $fields = [];
        for ($row = $minRow + 1; $row < $maxRow; $row++) {
            $column++;
            $fields[] = new BoardPosition($column, $row);
        }

        return $fields;
    }

    /**
     * @param BoardPositionInterface $startPosition
     * @param BoardPositionInterface $targetPosition
     * @return array<BoardPositionInterface>
     */
    private function getVerticallyFieldsBetween(
        BoardPositionInterface $startPosition,
        BoardPositionInterface $targetPosition
    ): array {
        $minRow = min($startPosition->getRow(), $targetPosition->getRow());
        $maxRow = max($startPosition->getRow(), $targetPosition->getRow());
        $column = $startPosition->getColumn();

        $fields = [];
        for ($row = $minRow+1; $row < $maxRow; $row++) {
            $fields[] = new BoardPosition($column, $row);
        }

        return $fields;
    }

    /**
     * @param BoardPositionInterface $startPosition
     * @param BoardPositionInterface $targetPosition
     * @return array<BoardPositionInterface>
     */
    private function getHorizontallyFieldsBetween(
        BoardPositionInterface $startPosition,
        BoardPositionInterface $targetPosition
    ): array {
        $row = $startPosition->getRow();
        $minColumn = min(ord($startPosition->getColumn()), ord($targetPosition->getColumn()));
        $maxColumn = max(ord($startPosition->getColumn()), ord($targetPosition->getColumn()));

        $fields = [];
        for ($column = ++$minColumn; $column < $maxColumn; $column++) {
            $columnStr = chr($column);
            $fields[] = new BoardPosition($columnStr, $row);
        }

        return $fields;
    }
}
