<?php

namespace App\Command;

use App\Repository\PretRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class VerifLoansCommand extends Command
{
    //https://symfony.com/doc/current/the-fast-track/fr/24-cron.html
    //https://openclassrooms.com/forum/sujet/symfony-4-creer-une-tache-cron
    private $commentRepository;

    protected static $defaultName = 'app:comment:cleanup';

    public function __construct(PretRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Check if customer loan bring date for return book')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('dry-run')) {
            $io->note('Dry mode enabled');

            $count = $this->commentRepository->countOldRejected();
        } else {
            $count = $this->commentRepository->deleteOldRejected();
        }

        $io->success(sprintf('Deleted "%d" old rejected/spam comments.', $count));

        return 0;
    }
}
