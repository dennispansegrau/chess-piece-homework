<?php
declare(strict_types=1);

namespace App\Tests\ChessRules;

use App\ChessRules\IsNotBlockedByOwnChessPieceRule;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPiece;
use App\Services\King;
use App\Services\Queen;
use PHPUnit\Framework\TestCase;

class IsNotBlockedByOwnChessPieceRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenPositionIsOccupiedByOwnChessPiece(): void
    {
        $board = new Board();
        $king = new King(ChessPiece::WHITE);
        $queen = new Queen(ChessPiece::WHITE);
        $kingsBoardPosition = new BoardPosition('d', 1);
        $queensBoardPosition = new BoardPosition('e', 1);
        $board->addChessPiece($king, $kingsBoardPosition);
        $board->addChessPiece($queen, $queensBoardPosition);

        $rule = new IsNotBlockedByOwnChessPieceRule();
        $isValidMove = $rule->isValidMove($board, $king, $kingsBoardPosition, $queensBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenPositionIsOccupiedByOpponentChessPiece(): void
    {
        $board = new Board();
        $king = new King(ChessPiece::WHITE);
        $queen = new Queen(ChessPiece::BLACK);
        $kingsBoardPosition = new BoardPosition('d', 1);
        $queensBoardPosition = new BoardPosition('e', 1);
        $board->addChessPiece($king, $kingsBoardPosition);
        $board->addChessPiece($queen, $queensBoardPosition);

        $rule = new IsNotBlockedByOwnChessPieceRule();
        $isValidMove = $rule->isValidMove($board, $king, $kingsBoardPosition, $queensBoardPosition);

        $this->assertTrue($isValidMove);
    }
}
