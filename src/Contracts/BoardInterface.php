<?php
declare(strict_types=1);

namespace App\Contracts;

interface BoardInterface
{
    /**
     * @param ChessPieceInterface $chessPiece
     * @param BoardPositionInterface $position
     */
    public function addChessPiece(ChessPieceInterface $chessPiece, BoardPositionInterface $position): void;

    /**
     * @param ChessPieceInterface $chessPiece
     * @return BoardPositionInterface|null
     */
    public function getPosition(ChessPieceInterface $chessPiece): ?BoardPositionInterface;

    /**
     * @param BoardPositionInterface $boardPosition
     * @return ChessPieceInterface|null
     */
    public function getChessPiece(BoardPositionInterface $boardPosition): ?ChessPieceInterface;
}
