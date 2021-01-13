<?php
declare(strict_types=1);

namespace App\Command;

use App\Factories\ChessPieceFactory;
use App\Services\Board;
use App\Services\BoardPosition;
use App\Services\ChessPieceAnalyser;
use App\Services\RulesValidator;
use Exception;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ChessCommand
 * @package App\Command
 */
class ChessCommand extends Command
{
    protected static $defaultName = 'chess';

    protected function configure(): void
    {
        $this
            ->setDescription('Shows all possible moves of a chosen chess piece.')
            ->setHelp('Shows all possible moves of a chosen chess piece.')
            ->addArgument(
                'board_position',
                InputArgument::OPTIONAL,
                'Chess piece position (a1 - h8)',
                $this->getRandomPosition()
            )
            ->addArgument(
                'chess_piece',
                InputArgument::OPTIONAL,
                'Chess piece (K-King, Q-Queen, R-Rook, B-Bishop, N-Knight, or P-Pawn)',
                $this->getRandomChessPiece()
            )
            ->addArgument(
                'chess_piece_color',
                InputArgument::OPTIONAL,
                'Chess piece color (b-black or w-white)',
                $this->getRandomColor()
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $chessPieceInput = $input->getArgument('chess_piece');
        $chessPieceColorInput = $input->getArgument('chess_piece_color');
        $boardPositionInput = $input->getArgument('board_position');

        if (!is_string($chessPieceInput) || !is_string($chessPieceColorInput) || !is_string($boardPositionInput)) {
            throw new InvalidArgumentException("Arguments must be strings!");
        }

        $output->writeln([
            'Chess Piece Homework',
            '========================================',
            "Selected chess piece: $chessPieceInput",
            "Selected chess piece color: $chessPieceColorInput",
            "Selected chess position: $boardPositionInput",
            '========================================',
        ]);

        $output->writeln('Possible moves:');
        $allPossibleMoves = $this->getAllPossibleMoves($chessPieceInput, $chessPieceColorInput, $boardPositionInput);
        foreach ($allPossibleMoves as $move) {
            $output->writeln($move);
        }

        return Command::SUCCESS;
    }

    /**
     * @return string
     */
    private function getRandomPosition(): string
    {
        try {
            return chr(random_int(97, 104)) . random_int(1, 8);
        } catch (Exception $e) {
            return 'a1';
        }
    }

    /**
     * @return string
     */
    private function getRandomChessPiece(): string
    {
        return array_rand(array_flip(['K', 'Q', 'R', 'B', 'N', 'P']));
    }

    /**
     * @return string
     */
    private function getRandomColor(): string
    {
        return array_rand(array_flip(['b', 'w']));
    }

    /**
     * @param string $chessPieceInput
     * @param string $chessPieceColorInput
     * @param string $boardPositionInput
     * @return array
     */
    private function getAllPossibleMoves(
        string $chessPieceInput,
        string $chessPieceColorInput,
        string $boardPositionInput
    ): array {
        $board = new Board();
        $chessPiece = ChessPieceFactory::createChessPiece($chessPieceInput, $chessPieceColorInput);
        $boardPosition = BoardPosition::createFromString($boardPositionInput);
        $board->addChessPiece($chessPiece, $boardPosition);
        $rulesValidator = new RulesValidator();
        $chessPieceAnalyser = new ChessPieceAnalyser($board, $rulesValidator);
        return $chessPieceAnalyser->getAllPossibleMoves($chessPiece);
    }
}
