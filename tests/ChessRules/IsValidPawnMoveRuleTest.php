<?php
declare(strict_types=1);

namespace App\Tests;

use App\ChessRules\IsValidPawnsMoveRule;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\Pawn;
use PHPUnit\Framework\TestCase;

class IsValidPawnMoveRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenNotAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Pawn(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 2);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 5);

        $rule = new IsValidPawnsMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Pawn(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 2);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 4);

        $rule = new IsValidPawnsMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
