<?php
declare(strict_types=1);

namespace App\Tests;

use App\ChessRules\IsValidQueenMoveRule;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\Queen;
use PHPUnit\Framework\TestCase;

class IsValidQueenMoveRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenNotAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Queen(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 2);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('b', 5);

        $rule = new IsValidQueenMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Queen(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('c', 3);

        $rule = new IsValidQueenMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
