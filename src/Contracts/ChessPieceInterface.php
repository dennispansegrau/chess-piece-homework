<?php
declare(strict_types=1);

namespace App\Contracts;

interface ChessPieceInterface
{
    public function getColor(): string;
}
