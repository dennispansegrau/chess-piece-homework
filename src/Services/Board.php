<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\ChessPieceInterface;
use App\Contracts\BoardPositionInterface;
use InvalidArgumentException;

class Board
{
    private array $fields;

    public function __construct()
    {
        for ($column = 'a'; $column <= 'h'; $column++) {
            for ($row = 1; $row <= 8; $row++) {
                $this->fields[$column][$row] = null;
            }
        }
    }

    public function addChessPiece(ChessPieceInterface $chessPiece, BoardPositionInterface $position): void
    {
        $column = $position->getColumn();
        $row = $position->getRow();

        if (!array_key_exists($column, $this->fields) || !array_key_exists($row, $this->fields[$column])) {
            throw new InvalidArgumentException("Field (column: $column, row: $row) does not exist!");
        }

        if (isset($this->fields[$column][$row])) {
            throw new InvalidArgumentException("Field (column: $column, row: $row) is already occupied!");
        }

        $this->fields[$column][$row] = $chessPiece;
    }

    public function getPosition(ChessPieceInterface $chessPiece): ?BoardPosition
    {
        for ($column = 'a'; $column <= 'h'; $column++) {
            for ($row = 1; $row <= 8; $row++) {
                if ($this->fields[$column][$row] === $chessPiece) {
                    return new BoardPosition($column, $row);
                }
            }
        }

        return null;
    }
}
