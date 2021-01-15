<?php
declare(strict_types=1);

namespace App\Tests\ChessRules;

use App\ChessRules\IsReachableRule;
use App\Contracts\BoardPositionInterface;
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
use PHPUnit\Framework\TestCase;

class IsReachableRuleTest extends TestCase
{
    public function testIsValidMoveExpectsFalseWhenOtherChessPieceBlocksWay(): void
    {
        $board = new Board();
        $king = new King(ChessPiece::WHITE);
        $queen = new Queen(ChessPiece::WHITE);
        $queensBoardPosition = new BoardPosition('a', 1);
        $kingsBoardPosition = new BoardPosition('d', 4);
        $queensNewBoardPosition = new BoardPosition('h', 8);
        $board->addChessPiece($king, $kingsBoardPosition);
        $board->addChessPiece($queen, $queensBoardPosition);

        $rule = new IsReachableRule();
        $isValidMove = $rule->isValidMove($board, $queen, $queensBoardPosition, $queensNewBoardPosition);

        $this->assertFalse($isValidMove);
    }

    public function testIsValidMoveExpectsTrueWhenNoOtherChessPieceBlocksWay(): void
    {
        $board = new Board();
        $king = new King(ChessPiece::WHITE);
        $queen = new Queen(ChessPiece::WHITE);
        $queensBoardPosition = new BoardPosition('a', 1);
        $kingsBoardPosition = new BoardPosition('b', 3);
        $queensNewBoardPosition = new BoardPosition('h', 8);
        $board->addChessPiece($king, $kingsBoardPosition);
        $board->addChessPiece($queen, $queensBoardPosition);

        $rule = new IsReachableRule();
        $isValidMove = $rule->isValidMove($board, $queen, $queensBoardPosition, $queensNewBoardPosition);

        $this->assertTrue($isValidMove);
    }

    /**
     * @dataProvider provider
     * @param ChessPiece $mainPiece
     * @param BoardPosition $mainPieceStartPosition
     * @param BoardPosition $mainPieceEndPosition
     * @param ChessPiece $otherPiece
     * @param BoardPosition $otherPiecePosition
     * @param bool $expected
     */
    public function testIsValidMoveMassTest(
        ChessPiece $mainPiece,
        BoardPosition $mainPieceStartPosition,
        BoardPosition $mainPieceEndPosition,
        ChessPiece $otherPiece,
        BoardPosition $otherPiecePosition,
        bool $expected
    ): void {
        $board = new Board();
        $board->addChessPiece($mainPiece, $mainPieceStartPosition);
        $board->addChessPiece($otherPiece, $otherPiecePosition);

        $rule = new IsReachableRule();
        $isValidMove = $rule->isValidMove($board, $mainPiece, $mainPieceStartPosition, $mainPieceEndPosition);

        $this->assertSame(
            $expected,
            $isValidMove,
            "Error: move $mainPiece from $mainPieceStartPosition to $mainPieceEndPosition " .
            "with $otherPiece on position $otherPiecePosition"
        );
    }

    /**
     * @return array[]
     */
    public function provider(): array
    {
        return [
            [
                new Queen(Queen::WHITE),
                new BoardPosition('c', 2),
                new BoardPosition('f', 2),
                new Pawn(Queen::WHITE),
                new BoardPosition('e', 2),
                false
            ],
            [
                new Queen(Queen::WHITE),
                new BoardPosition('c', 2),
                new BoardPosition('f', 2),
                new Pawn(Queen::WHITE),
                new BoardPosition('e', 3),
                true
            ],
            [
                new Queen(Queen::WHITE),
                new BoardPosition('b', 3),
                new BoardPosition('f', 2),
                new Pawn(Queen::WHITE),
                new BoardPosition('e', 6),
                true
            ],
            [
                new Queen(Queen::WHITE),
                new BoardPosition('b', 3),
                new BoardPosition('d', 5),
                new Pawn(Queen::WHITE),
                new BoardPosition('e', 6),
                true
            ],
            [
                new Queen(Queen::WHITE),
                new BoardPosition('b', 3),
                new BoardPosition('e', 6),
                new Pawn(Queen::WHITE),
                new BoardPosition('d', 5),
                false
            ],
            [
                new Queen(Queen::WHITE),
                new BoardPosition('a', 1),
                new BoardPosition('a', 8),
                new Pawn(Queen::WHITE),
                new BoardPosition('a', 6),
                false
            ],
            [
                new Queen(Queen::WHITE),
                new BoardPosition('a', 1),
                new BoardPosition('a', 6),
                new Pawn(Queen::WHITE),
                new BoardPosition('a', 7),
                true
            ],
            [
                new Pawn(Pawn::WHITE),
                new BoardPosition('a', 2),
                new BoardPosition('a', 4),
                new Pawn(Queen::BLACK),
                new BoardPosition('a', 3),
                false
            ],
            [
                new Pawn(Pawn::WHITE),
                new BoardPosition('a', 2),
                new BoardPosition('a', 4),
                new Pawn(Queen::BLACK),
                new BoardPosition('a', 5),
                true
            ],
            [
                new Pawn(Rook::WHITE),
                new BoardPosition('a', 2),
                new BoardPosition('a', 6),
                new Pawn(Rook::BLACK),
                new BoardPosition('a', 5),
                false
            ],
            [
                new Pawn(Rook::WHITE),
                new BoardPosition('a', 2),
                new BoardPosition('a', 5),
                new Pawn(Rook::BLACK),
                new BoardPosition('a', 6),
                true
            ],
            [
                new Rook(Rook::WHITE),
                new BoardPosition('a', 2),
                new BoardPosition('g', 2),
                new Rook(Rook::BLACK),
                new BoardPosition('f', 2),
                false
            ],
            [
                new Rook(Rook::WHITE),
                new BoardPosition('a', 2),
                new BoardPosition('f', 2),
                new Rook(Rook::BLACK),
                new BoardPosition('g', 2),
                true
            ],
            [
                new Rook(Rook::WHITE),
                new BoardPosition('b', 2),
                new BoardPosition('b', 7),
                new Rook(Rook::BLACK),
                new BoardPosition('b', 6),
                false
            ],
            [
                new Rook(Rook::WHITE),
                new BoardPosition('d', 2),
                new BoardPosition('d', 6),
                new Rook(Rook::BLACK),
                new BoardPosition('d', 7),
                true
            ],
            [
                new Bishop(Bishop::WHITE),
                new BoardPosition('b', 3),
                new BoardPosition('g', 8),
                new Rook(Rook::BLACK),
                new BoardPosition('d', 7),
                true
            ],
            [
                new Bishop(Bishop::WHITE),
                new BoardPosition('b', 3),
                new BoardPosition('g', 8),
                new Rook(Rook::BLACK),
                new BoardPosition('f', 7),
                false
            ],
            [
                new Bishop(Bishop::WHITE),
                new BoardPosition('g', 8),
                new BoardPosition('b', 3),
                new Rook(Rook::BLACK),
                new BoardPosition('d', 7),
                true
            ],
            [
                new Rook(Bishop::WHITE),
                new BoardPosition('g', 8),
                new BoardPosition('b', 3),
                new Rook(Rook::BLACK),
                new BoardPosition('c', 4),
                false
            ],
            [
                new Knight(Knight::WHITE),
                new BoardPosition('a', 1),
                new BoardPosition('b', 3),
                new Rook(Rook::BLACK),
                new BoardPosition('a', 2),
                true
            ],
            [
                new Knight(Knight::WHITE),
                new BoardPosition('a', 1),
                new BoardPosition('b', 3),
                new Rook(Rook::BLACK),
                new BoardPosition('b', 2),
                true
            ],
            [
                new Knight(Knight::WHITE),
                new BoardPosition('a', 1),
                new BoardPosition('b', 3),
                new Rook(Rook::BLACK),
                new BoardPosition('b', 1),
                true
            ],
            [
                new Knight(Knight::WHITE),
                new BoardPosition('a', 1),
                new BoardPosition('b', 3),
                new Rook(Rook::BLACK),
                new BoardPosition('b', 1),
                true
            ],
        ];
    }
}
