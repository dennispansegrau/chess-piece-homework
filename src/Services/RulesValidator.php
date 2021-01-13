<?php
declare(strict_types=1);

namespace App\Services;

use App\ChessRules\IsValidBishopMoveRule;
use App\ChessRules\IsValidKingMoveRule;
use App\ChessRules\IsValidKnightMoveRule;
use App\ChessRules\IsValidQueenMoveRule;
use App\ChessRules\IsValidRookMoveRule;
use App\Contracts\ChessPieceInterface;
use App\ChessRules\NotSameFieldRule;

class RulesValidator
{
    private const ENABLED_RULES = [
        NotSameFieldRule::class,
        IsValidKingMoveRule::class,
        IsValidQueenMoveRule::class,
        IsValidRookMoveRule::class,
        IsValidBishopMoveRule::class,
        IsValidKnightMoveRule::class,
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
