<?php
declare(strict_types=1);

namespace App\Tests;

use App\ChessRules\IsValidKnightMoveRule;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\Knight;
use PHPUnit\Framework\TestCase;

class IsValidKnightMoveRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenNotAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Knight(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 5);

        $rule = new IsValidKnightMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Knight(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('b', 3);

        $rule = new IsValidKnightMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
