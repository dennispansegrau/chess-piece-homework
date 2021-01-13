<?php
declare(strict_types=1);

namespace App\Tests;

use App\ChessRules\IsNotSameFieldRule;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\King;
use PHPUnit\Framework\TestCase;

class IsNotSameFieldRuleTest extends TestCase
{
    public function testIsValidMoveIsFalseWhenSamePositions(): void
    {
        $board = new Board();
        $chessPiece = new King(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 1);

        $rule = new IsNotSameFieldRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveIsTrueWhenPositionsAreDifferent(): void
    {
        $board = new Board();
        $chessPiece = new King(ChessPiece::WHITE);
        $currentBoardPosition = new BoardPosition('a', 1);
        $board->addChessPiece($chessPiece, $currentBoardPosition);
        $newBoardPosition = new BoardPosition('a', 2);

        $rule = new IsNotSameFieldRule();
        $isValidMove = $rule->isValidMove($board, $chessPiece, $currentBoardPosition, $newBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
