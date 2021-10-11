<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Exemplaire;
use App\Entity\Pret;
use App\Entity\Genre;
use App\Entity\Langue;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book")
     */
    public function index(Request $request): Response
    {
        $exemplaires = $this->getDoctrine()
            ->getRepository(Exemplaire::class)
            ->searchAllBookBiblio();
        $posts = "";
        // If we coming after click on searh button
        if($request->isMethod('post')){
            $posts = $request->request->all();

            if ($posts['titre'] == "" && $posts['auteur'] == "" && $posts['genre'] == "" && $posts['langue'] == "") {
                $books = $this->getDoctrine()
                    ->getRepository(Livre::class)
                    ->searchAllBooks();

            } else {
                $books = $this->getDoctrine()
                    ->getRepository(Livre::class)
                    ->searchAllBooksWithFilters($posts);
            }

        } else {
            $books = $this->getDoctrine()
                ->getRepository(Livre::class)
                ->searchAllBooks();
        }

        $genres = $this->getDoctrine()
            ->getRepository(Genre::class)
            ->findAll();

        $langues = $this->getDoctrine()
            ->getRepository(Langue::class)
            ->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'exemplaires' => $exemplaires,
            'genres' => $genres,
            'langues' => $langues,
            'posts' => $posts,
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
