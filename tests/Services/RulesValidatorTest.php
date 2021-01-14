<?php
declare(strict_types=1);

namespace App\Tests\Services;

use App\Contracts\ChessPieceInterface;
use App\Services\Bishop;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\King;
use App\Services\Knight;
use App\Services\Pawn;
use App\Services\Queen;
use App\Services\Rook;
use App\Services\RulesValidator;
use PHPUnit\Framework\TestCase;

class RulesValidatorTest extends TestCase
{
    /**
     * @dataProvider provider
     * @param string $chessPieceType
     * @param string $chessPieceColor
     * @param string $column1
     * @param int $row1
     * @param string $column2
     * @param int $row2
     * @param bool $expected
     * @psalm-suppress InvalidCast
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function testIsValidMove(
        string $chessPieceType,
        string $chessPieceColor,
        string $column1,
        int $row1,
        string $column2,
        int $row2,
        bool $expected
    ): void {
        $board = new Board();
        $chessPiece = new $chessPieceType($chessPieceColor);
        $currentBoardPosition = new BoardPosition($column1, $row1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition($column2, $row2);

        $rulesValidator = new RulesValidator();
        $isValidMove = $rulesValidator->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertSame(
            $expected,
            $isValidMove,
            "Error: $chessPiece move from $currentBoardPosition to $newBoardPosition."
        );
    }

    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            // allowed moves
            [King::class, ChessPiece::WHITE, 'a', 1, 'a', 2, true],
            [Queen::class, ChessPiece::WHITE, 'a', 1, 'a', 2, true],
            [Bishop::class, ChessPiece::WHITE, 'a', 1, 'b', 2, true],
            [Knight::class, ChessPiece::WHITE, 'a', 1, 'b', 3, true],
            [Rook::class, ChessPiece::WHITE, 'a', 1, 'a', 2, true],
            [Pawn::class, ChessPiece::WHITE, 'a', 1, 'a', 2, true],
            // same positions
            [Rook::class, ChessPiece::WHITE, 'a', 1, 'a', 1, false],
            [Pawn::class, ChessPiece::WHITE, 'a', 1, 'a', 1, false],
            // not allowed moves
            [King::class, ChessPiece::WHITE, 'a', 1, 'a', 3, false],
            [Queen::class, ChessPiece::WHITE, 'a', 1, 'b', 4, false],
            [Bishop::class, ChessPiece::WHITE, 'a', 1, 'b', 3, false],
            [Knight::class, ChessPiece::WHITE, 'a', 1, 'b', 2, false],
            [Rook::class, ChessPiece::WHITE, 'a', 1, 'b', 2, false],
            [Pawn::class, ChessPiece::WHITE, 'a', 1, 'a', 3, false],
        ];
    }
}
