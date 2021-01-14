<?php
declare(strict_types=1);

namespace App\Tests\Factories;

use App\Factories\ChessPieceFactory;
use App\Services\Bishop;
use App\Services\ChessPiece;
use App\Services\King;
use App\Services\Knight;
use App\Services\Pawn;
use App\Services\Queen;
use App\Services\Rook;
use PHPUnit\Framework\TestCase;

class ChessPieceFactoryTest extends TestCase
{
    /**
     * @dataProvider provider
     * @param string $input
     * @param string $expectedType
     */
    public function testCreateChessPiece(string $input, string $expectedType): void
    {
        $chessPiece = ChessPieceFactory::createChessPiece($input, ChessPiece::WHITE);
        $this->assertSame($expectedType, $chessPiece::class);
    }

    public function testCreateChessPieceWithWrongInput(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $chessPiece = ChessPieceFactory::createChessPiece('X', ChessPiece::WHITE);
    }

    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            ['K', King::class],
            ['Q', Queen::class],
            ['B', Bishop::class],
            ['R', Rook::class],
            ['N', Knight::class],
            ['P', Pawn::class],
            ['k', King::class],
            ['q', Queen::class],
            ['b', Bishop::class],
            ['r', Rook::class],
            ['n', Knight::class],
            ['p', Pawn::class],
        ];
    }
}
