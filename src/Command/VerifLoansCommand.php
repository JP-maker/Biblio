<?php

namespace App\Command;

use App\Repository\PretRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class VerifLoansCommand extends Command
{

    private PretRepository $pretRepository;
    private MailerInterface $mailer;

    protected static $defaultName = 'app:checkreturn';

    public function __construct(PretRepository $pretRepository, MailerInterface $mailer)
    {
        $this->pretRepository = $pretRepository;
        $this->mailer = $mailer;

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

        $result = $this->pretRepository->checkBooksNeedToBack();
        if ($result) {
            foreach ($result as $pret) {
                $display[] = $pret->getUtilisateur()->getEmail();
                $email = (new Email())
                    ->from('noreply@bilbioPC.fr')
                    ->to($pret->getUtilisateur()->getEmail())
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Votre période de prêt est dépassée')
                    ->html('<p>Bonjour '.$pret->getUtilisateur()->getPrenom().',</p>
                        <p>Il est temps de nous retourner le livre '.$pret->getExemplaire()->getIsbn()->getTitre().'</p>
                        <p>En effet, la période de prêt se terminait le '.$pret->getDateFin()->format('d/m/Y').'</p>
                        <p>Merci à vous et à très bientot.</p>
                        <p>Votre bibliothèque</p>');
                /* No send. Because need to have a smtp
                $this->mailer->send($email);
                */
            }
        }
        $io->success('Check done. Id(s) : '.implode(",",$display));

        return 0;
    }
}
