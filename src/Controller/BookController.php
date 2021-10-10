<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Exemplaire;
use App\Entity\Pret;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book")
     */
    public function index(): Response
    {

        $books = $this->getDoctrine()
            ->getRepository(Livre::class)
            ->searchAllBooks();

        $exemplaires = $this->getDoctrine()
            ->getRepository(Exemplaire::class)
            ->searchAllBookBiblio();

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'exemplaires' => $exemplaires
        ]);
    }

    /**
     * @Route("/loan", name="loan")
     */
    public function loan(): Response
    {
        $prets = $this->getDoctrine()
            ->getRepository(Pret::class)
            ->searchAllBooks($this->getUser());

        return $this->render('book/loan.html.twig', [
            'prets' => $prets
        ]);
    }

    /**
     * @Route("/loan/more/{id}", name="more_loan")
     */
    public function moreLoan(Request $request): Response
    {
        $pret = $this->getDoctrine()
            ->getRepository(Pret::class)
            ->findOneBy(['id' => $request->get('id')]);
        $dateFin = $pret->getDateFin();
        $dateFin->add(new \DateInterval('P7D'));
        $pret->setDateFin($dateFin);
        $pret->setRenouvele(false);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pret);
        $entityManager->flush();

        return $this->redirectToRoute('loan');
    }
}
