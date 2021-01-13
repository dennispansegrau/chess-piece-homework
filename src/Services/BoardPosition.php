<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BoardPositionInterface;
use InvalidArgumentException;

class BoardPosition implements BoardPositionInterface
{
    private string $column;
    private int $row;

    /**
     * BoardPosition constructor.
     * @param string $column
     * @param int $row
     */
    public function __construct(string $column, int $row)
    {
        $column = strtolower($column);

        if (ord($column) < 97 || ord($column) > 104) {
            throw new InvalidArgumentException("$column is not a valid chess board column!");
        }

        if ($row < 1 || $row > 8) {
            throw new InvalidArgumentException("$row is not a valid chess board row!");
        }

        $this->column = $column;
        $this->row = $row;
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * Get the columns a to h as 1 to 8
     * @return int
     */
    public function getColumnAsInt(): int
    {
        return ord($this->column) - 96;
    }

    /**
     * @param string $input
     * @return BoardPosition
     */
    public static function createFromString(string $input): self
    {
        if (strlen($input) < 2 || !ctype_alpha($input[0]) || !ctype_digit($input[1])) {
            throw new InvalidArgumentException("$input is not a valid chess board position!");
        }

        return new self($input[0], (int)$input[1]);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->column . $this->row;
    }

    /**
     * @param BoardPositionInterface $otherPosition
     * @return bool
     */
    public function isDiagonally(BoardPositionInterface $otherPosition): bool
    {
        return abs($this->getColumnAsInt() - $otherPosition->getColumnAsInt()) ===
            abs($this->getRow() - $otherPosition->getRow());
    }

    /**
     * @param BoardPositionInterface $otherPosition
     * @return bool
     */
    public function isHorizontally(BoardPositionInterface $otherPosition): bool
    {
        return $this->getRow() === $otherPosition->getRow();
    }

    /**
     * @param BoardPositionInterface $otherPosition
     * @return bool
     */
    public function isVertically(BoardPositionInterface $otherPosition): bool
    {
        return $this->getColumn() === $otherPosition->getColumn();
    }
}
