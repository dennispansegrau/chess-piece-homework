<?php
declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\ChessCommand;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

class ChessCommandTest extends TestCase
{
    public function testGetRandomPosition(): void
    {
        $command = new ChessCommand();
        $positionString = $this->invokeMethod($command, 'getRandomPosition');
        $this->assertIsString($positionString);
        $this->assertNotEmpty($positionString);
    }

    public function testGetRandomChessPiece(): void
    {
        $command = new ChessCommand();
        $chessPieceString = $this->invokeMethod($command, 'getRandomChessPiece');
        $this->assertIsString($chessPieceString);
        $this->assertNotEmpty($chessPieceString);
    }

    public function testGetRandomColor(): void
    {
        $command = new ChessCommand();
        $color = $this->invokeMethod($command, 'getRandomColor');
        $this->assertIsString($color);
        $this->assertNotEmpty($color);
    }

    public function testGetAllPossibleMoves(): void
    {
        $command = new ChessCommand();
        $moves = $this->invokeMethod($command, 'getAllPossibleMoves', ['K', 'w', 'a1']);
        $this->assertIsArray($moves);
        $this->assertNotEmpty($moves);
    }

    /**
     * @param object $object
     * @param string $methodName
     * @param array $parameters
     * @return mixed
     * @throws ReflectionException
     */
    private function invokeMethod(object $object, string $methodName, array $parameters = array()): mixed
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
