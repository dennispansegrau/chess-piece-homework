<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BoardInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\BoardPositionInterface;
use InvalidArgumentException;

class Board implements BoardInterface
{
    /**
     * @var array<string, array<null|ChessPieceInterface>>
     */
    private array $fields;

    /**
     * Board constructor.
     * @psalm-suppress StringIncrement
     */
    public function __construct()
    {
        $this->fields = [];

        for ($column = 'a'; $column <= 'h'; $column++) {
            for ($row = 1; $row <= 8; $row++) {
                $this->fields[$column][$row] = null;
            }
        }
    }

    /**
     * @param ChessPieceInterface $chessPiece
     * @param BoardPositionInterface $position
     */
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

    /**
     * @param ChessPieceInterface $chessPiece
     * @return BoardPositionInterface|null
     * @psalm-suppress StringIncrement
     */
    public function getPosition(ChessPieceInterface $chessPiece): ?BoardPositionInterface
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
