<?php
declare(strict_types=1);

namespace App\Services;

use App\ChessRules\KingMovesRule;
use App\Contracts\ChessPieceInterface;
use App\ChessRules\NotSameFieldRule;

class RulesValidator
{
    private const ENABLED_RULES = [
        NotSameFieldRule::class,
        KingMovesRule::class,
    ];

    private array $rules;

    public function __construct()
    {
        foreach (self::ENABLED_RULES as $rule) {
            $this->rules[] = new $rule();
        }
    }

    public function isValidMove(
        Board $board,
        ChessPieceInterface $chessPiece,
        BoardPosition $currentBoardPosition,
        BoardPosition $possibleNewBoardPosition
    ): bool {

        foreach ($this->rules as $rule) {
            if (!$rule->isValidMove($board, $chessPiece, $currentBoardPosition, $possibleNewBoardPosition)) {
                return false;
            }
        }

        return true;
    }
}
