<?php
declare(strict_types=1);

namespace App\Services;

use App\ChessRules\IsValidBishopMoveRule;
use App\ChessRules\IsValidKingMoveRule;
use App\ChessRules\IsValidKnightMoveRule;
use App\ChessRules\IsValidPawnsMoveRule;
use App\ChessRules\IsValidQueenMoveRule;
use App\ChessRules\IsValidRookMoveRule;
use App\Contracts\BoardInterface;
use App\Contracts\BoardPositionInterface;
use App\Contracts\ChessPieceInterface;
use App\ChessRules\IsNotSameFieldRule;
use App\Contracts\ChessRulesInterface;

class RulesValidator implements ChessRulesInterface
{
    private const ENABLED_RULES = [
        IsNotSameFieldRule::class,
        IsValidKingMoveRule::class,
        IsValidQueenMoveRule::class,
        IsValidRookMoveRule::class,
        IsValidBishopMoveRule::class,
        IsValidKnightMoveRule::class,
        IsValidPawnsMoveRule::class,
    ];

    private array $rules;

    public function __construct()
    {
        foreach (self::ENABLED_RULES as $rule) {
            $this->rules[] = new $rule();
        }
    }

    public function isValidMove(
        BoardInterface $board,
        ChessPieceInterface $chessPiece,
        BoardPositionInterface $currentBoardPosition,
        BoardPositionInterface $possibleNewBoardPosition
    ): bool {

        foreach ($this->rules as $rule) {
            if (!$rule->isValidMove($board, $chessPiece, $currentBoardPosition, $possibleNewBoardPosition)) {
                return false;
            }
        }

        return true;
    }
}