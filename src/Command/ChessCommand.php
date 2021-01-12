<?php
declare(strict_types=1);

namespace App\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChessCommand extends Command
{
    protected static $defaultName = 'chess';

    protected function configure(): void
    {
        $this
            ->setDescription('Shows all possible moves of a chosen chess piece.')
            ->addArgument(
                'chess_piece',
                InputArgument::OPTIONAL,
                'Chess piece (K-King, Q-Queen, R-Rook, B-Bishop, N-Knight, or P-Pawn)',
                $this->getRandomChessPiece()
            )
            ->addArgument(
                'position',
                InputArgument::OPTIONAL,
                'Chess piece position (a1 - h8)',
                $this->getRandomPosition()
            )
            ->setHelp('Shows all possible moves of a chosen chess piece.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $chessPiece */
        $chessPiece = $input->getArgument('chess_piece');
        /** @var string $position */
        $position = $input->getArgument('position');

        $output->writeln([
            'Chess Piece Homework',
            '========================================',
            "Selected chess piece: $chessPiece",
            "Selected chess piece position: $position",
            '========================================',
        ]);

        $output->writeln('Whoa!');

        return Command::SUCCESS;
    }

    /**
     * @return string
     */
    private function getRandomPosition(): string
    {
        try {
            return chr(random_int(97, 104)) . (string)random_int(1, 8);
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
}
