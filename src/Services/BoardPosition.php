<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BoardPositionInterface;
use InvalidArgumentException;

class BoardPosition implements BoardPositionInterface
{
    private string $column;
    private int $row;

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

    public function getRow(): int
    {
        return $this->row;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public static function createFromString(string $input): self
    {
        if (strlen($input) < 2 || !ctype_alpha($input[0]) || !ctype_digit($input[1])) {
            throw new InvalidArgumentException("$input is not a valid chess board position!");
        }

        return new self($input[0], (int)$input[1]);
    }

    public function __toString(): string
    {
        return $this->column . (string)$this->row;
    }
}
