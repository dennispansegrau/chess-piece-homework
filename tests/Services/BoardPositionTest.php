<?php
declare(strict_types=1);

namespace App\Tests\Services;

use App\Services\BoardPosition;
use PHPUnit\Framework\TestCase;

class BoardPositionTest extends TestCase
{
    /**
     * @dataProvider columnAsIntProvider
     * @param string $column
     * @param int $row
     * @param int $expectedValue
     */
    public function testGetColumnAsInt(string $column, int $row, int $expectedValue): void
    {
        $boardPosition = new BoardPosition($column, $row);
        $value = $boardPosition->getColumnAsInt();
        $this->assertSame($expectedValue, $value);
    }

    /**
     * @dataProvider columnAsIntProvider
     * @param string $column
     * @param int $row
     */
    public function testGetters(string $column, int $row): void
    {
        $boardPosition = new BoardPosition($column, $row);
        $objColumn = $boardPosition->getColumn();
        $objRow = $boardPosition->getRow();
        $this->assertSame($column, $objColumn);
        $this->assertSame($row, $objRow);
    }

    /**
     * @psalm-suppress RedundantCondition
     */
    public function testCreateFromStringWithoutExceptions(): void
    {
        $boardPosition = BoardPosition::createFromString('a1');
        $this->assertIsObject($boardPosition);

        $boardPosition = BoardPosition::createFromString('h1');
        $this->assertIsObject($boardPosition);

        $boardPosition = BoardPosition::createFromString('h8');
        $this->assertIsObject($boardPosition);

        $boardPosition = BoardPosition::createFromString('a8');
        $this->assertIsObject($boardPosition);
    }

    public function testToString(): void
    {
        $boardPosition = new BoardPosition('a', 1);
        $this->assertSame('a1', (string)$boardPosition);

        $boardPosition = new BoardPosition('h', 8);
        $this->assertSame('h8', (string)$boardPosition);
    }

    public function testIsDiagonally()
    {
        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('b', 2);
        $this->assertTrue($boardPosition1->isDiagonally($boardPosition2));


        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('h', 8);
        $this->assertTrue($boardPosition1->isDiagonally($boardPosition2));


        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('h', 1);
        $this->assertFalse($boardPosition1->isDiagonally($boardPosition2));


        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('a', 7);
        $this->assertFalse($boardPosition1->isDiagonally($boardPosition2));
    }

    public function testIsHorizontally()
    {
        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('h', 1);
        $this->assertTrue($boardPosition1->isHorizontally($boardPosition2));


        $boardPosition1 = new BoardPosition('c', 6);
        $boardPosition2 = new BoardPosition('f', 6);
        $this->assertTrue($boardPosition1->isHorizontally($boardPosition2));


        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('a', 5);
        $this->assertFalse($boardPosition1->isHorizontally($boardPosition2));


        $boardPosition1 = new BoardPosition('d', 1);
        $boardPosition2 = new BoardPosition('d', 7);
        $this->assertFalse($boardPosition1->isHorizontally($boardPosition2));
    }

    public function testIsVertically()
    {
        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('a', 5);
        $this->assertTrue($boardPosition1->isVertically($boardPosition2));


        $boardPosition1 = new BoardPosition('f', 5);
        $boardPosition2 = new BoardPosition('f', 3);
        $this->assertTrue($boardPosition1->isVertically($boardPosition2));


        $boardPosition1 = new BoardPosition('a', 1);
        $boardPosition2 = new BoardPosition('h', 4);
        $this->assertFalse($boardPosition1->isVertically($boardPosition2));


        $boardPosition1 = new BoardPosition('a', 4);
        $boardPosition2 = new BoardPosition('d', 7);
        $this->assertFalse($boardPosition1->isVertically($boardPosition2));
    }

    /**
     * @return array
     */
    public function columnAsIntProvider(): array
    {
        return [
            ['a', 1, 1],
            ['b', 2, 2],
            ['c', 3, 3],
            ['d', 4, 4],
            ['e', 5, 5],
            ['f', 6, 6],
            ['g', 7, 7],
            ['h', 8, 8],
        ];
    }
}
