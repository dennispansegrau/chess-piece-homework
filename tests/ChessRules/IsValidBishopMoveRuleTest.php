<?php
declare(strict_types=1);

namespace App\Tests;

use App\ChessRules\IsValidBishopMoveRule;
use App\Services\Bishop;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use PHPUnit\Framework\TestCase;

class IsValidBishopMoveRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenNotDiagonallyMove(): void
    {
        $board = new Board();
        $chessPiece = new Bishop(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 2);

        $rule = new IsValidBishopMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenDiagonallyMove(): void
    {
        $board = new Board();
        $chessPiece = new Bishop(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('b', 2);

        $rule = new IsValidBishopMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
