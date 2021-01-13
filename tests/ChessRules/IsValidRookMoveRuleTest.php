<?php
declare(strict_types=1);

namespace App\Tests;

use App\ChessRules\IsValidRookMoveRule;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\Rook;
use PHPUnit\Framework\TestCase;

class IsValidRookMoveRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenNotAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Rook(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 2);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('b', 5);

        $rule = new IsValidRookMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenAllowedMove(): void
    {
        $board = new Board();
        $chessPiece = new Rook(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 2);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 8);

        $rule = new IsValidRookMoveRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
