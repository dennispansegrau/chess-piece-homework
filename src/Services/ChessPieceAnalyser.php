<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BoardInterface;
use App\Contracts\ChessPieceInterface;
use App\Contracts\ChessRulesInterface;
use RuntimeException;

/**
 * Class ChessPieceAnalyser
 * @package App\Services
 */
class ChessPieceAnalyser
{
    private BoardInterface $board;
    private ChessRulesInterface $rulesValidator;

    /**
     * ChessPieceAnalyser constructor.
     * @param BoardInterface $board
     * @param ChessRulesInterface $rulesValidator
     */
    public function __construct(BoardInterface $board, ChessRulesInterface $rulesValidator)
    {
        $this->board = $board;
        $this->rulesValidator = $rulesValidator;
    }

    /**
     * @param ChessPieceInterface $chessPiece
     * @return array
     * @psalm-suppress StringIncrement
     */
    public function getAllPossibleMoves(ChessPieceInterface $chessPiece): array
    {
        $currentBoardPosition = $this->board->getPosition($chessPiece);
        if ($currentBoardPosition === null) {
            throw new RuntimeException("The chess piece was not found on the board!");
        }

        $allPossibleMoves = [];
        for ($column = 'a'; $column <= 'h'; $column++) {
            for ($row = 1; $row <= 8; $row++) {
                $possibleNewBoardPosition = new BoardPosition($column, $row);
                if (!$this->rulesValidator->isValidMove(
                    $this->board,
                    $chessPiece,
                    $currentBoardPosition,
                    $possibleNewBoardPosition
                )) {
                    continue;
                }
                $allPossibleMoves[] = $possibleNewBoardPosition;
            }
        }

        return $allPossibleMoves;
    }
}
