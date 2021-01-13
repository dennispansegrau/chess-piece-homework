<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\ChessPieceInterface;

class ChessPieceAnalyser
{
    private Board $board;
    private RulesValidator $rulesValidator;

    public function __construct(Board $board, RulesValidator $rulesValidator)
    {
        $this->board = $board;
        $this->rulesValidator = $rulesValidator;
    }

    public function getAllPossibleMoves(ChessPieceInterface $chessPiece): array
    {
        $currentBoardPosition = $this->board->getPosition($chessPiece);
        $allPossibleMoves = [];

        for ($column = 'a'; $column <= 'h'; $column++) {
            for ($row = 1; $row <= 8; $row++) {
                $possibleNewBoardPosition = new BoardPosition($column, $row);
                if (!$this->rulesValidator->isValidMove($this->board, $chessPiece, $currentBoardPosition, $possibleNewBoardPosition)) {
                    continue;
                }
                $allPossibleMoves[] = $possibleNewBoardPosition;
            }
        }

        return $allPossibleMoves;
    }
}
