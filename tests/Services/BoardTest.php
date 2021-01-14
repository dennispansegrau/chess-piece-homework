<?php
declare(strict_types=1);

namespace App\Tests\Services;

use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\King;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testAddChessPiece(): void
    {
        $chessPiece = new King(King::WHITE);
        $boardPosition = new BoardPosition('a', 1);

        $board = new Board();
        $board->addChessPiece($chessPiece, $boardPosition);

        $position = $board->getPosition($chessPiece);

        $this->assertNotNull($position);
        $this->assertSame($boardPosition->getRow(), $position->getRow());
        $this->assertSame($boardPosition->getColumn(), $position->getColumn());
    }

    public function testGetPosition(): void
    {
        $chessPiece = new King(King::WHITE);
        $board = new Board();
        $position = $board->getPosition($chessPiece);

        $this->assertNull($position);
    }
}
