<?php
declare(strict_types=1);

namespace App\Tests\Services;

use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPieceAnalyser;
use App\Services\King;
use App\Services\RulesValidator;
use PHPUnit\Framework\TestCase;

class ChessPieceAnalyserTest extends TestCase
{
    public function testGetAllPossibleMoves(): void
    {
        $board = new Board();
        $king = new King(King::BLACK);
        $position = new BoardPosition('a', 1);
        $board->addChessPiece($king, $position);
        $rulesValidator = new RulesValidator();
        $analyser = new ChessPieceAnalyser($board, $rulesValidator);
        $possibleMoves = $analyser->getAllPossibleMoves($king);
        $this->assertCount(3, $possibleMoves);
    }
}
