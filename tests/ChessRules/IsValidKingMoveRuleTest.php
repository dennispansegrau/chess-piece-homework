<?php
declare(strict_types=1);

namespace App\Tests;

use App\ChessRules\IsValidKingMoveRule;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\King;
use PHPUnit\Framework\TestCase;

class IsValidKingMoveRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenNotAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new King(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 5);

        $rule = new IsValidKingMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new King(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('b', 2);

        $rule = new IsValidKingMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
