<?php
declare(strict_types=1);

namespace App\Contracts;

interface BoardInterface
{
    public function addChessPiece(ChessPieceInterface $chessPiece, BoardPositionInterface $position): void;
    public function getPosition(ChessPieceInterface $chessPiece): ?BoardPositionInterface;
}
