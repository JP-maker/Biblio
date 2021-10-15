<?php

namespace App\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function index(): Response
    {

        // WITHOUT DATA I USE VARIABLES FOR FILL CHART

        $pieChartTopBook = new PieChart();
        $pieChartTopBook->getOptions()->setTitle('Top 10 des mangas les plus empruntés');
        $pieChartTopBook->getData()->setArrayToDataTable([
            ['Titre', 'Pourcentage'],
            ['Dragon Ball', 11],
            ['Akira', 10],
            ['Gunnm', 7],
            ['Death Note', 6],
            ['L\'attaque des titans', 2],
            ['Monster', 2],
            ['Berserk', 2],
            ['Naruto', 2],
            ['Fullmetal Alchemist', 1],
            ['GTO', 1]
        ]);

        $pieChartBadBook = new PieChart();
        $pieChartBadBook->getOptions()->setTitle('Top 10 des genres les plus empruntés');
        $pieChartBadBook->getData()->setArrayToDataTable([
            ['Titre', 'Emprunt total'],
            ['Manga', 8],
            ['Roman', 4],
            ['Polar', 3],
            ['Fantasy', 2],
            ['BD', 2],
            ['Livres enfants', 2],
            ['Cuisine', 2],
            ['Histoire', 1],
            ['Bricolage', 1],
            ['Santé', 1]
        ]);

        $barTopAutor = new BarChart();
        $barTopAutor->getData()->setArrayToDataTable([
            ['Auteur', 'Nombre d\'emprunt'],
            ['Oda', 50],
            ['Toriyama', 45],
            ['Ken Wakui', 30],
            ['Hajime Kômoto', 20],
            ['Chuqonq', 12]
        ]);
        $barTopAutor->getOptions()->setTitle('Top 5 des auteurs les plus lus');
        $barTopAutor->getOptions()->getHAxis()->setTitle('Nombre d\'emprunts');
        $barTopAutor->getOptions()->getHAxis()->setMinValue(0);
        $barTopAutor->getOptions()->getVAxis()->setTitle('Auteur');

        $barBadAutor = new BarChart();
        $barBadAutor->getData()->setArrayToDataTable([
            ['Auteur', 'Nombre d\'emprunt'],
            ['Sakurai', 2],
            ['Flipflop', 4],
            ['Gotouge', 5],
            ['Endo', 6],
            ['Nanasho', 6]
        ]);
        $barBadAutor->getOptions()->setTitle('Top 5 des auteurs les moins lus');
        $barBadAutor->getOptions()->getHAxis()->setTitle('Nombre d\'emprunts');
        $barBadAutor->getOptions()->getHAxis()->setMinValue(0);
        $barBadAutor->getOptions()->getVAxis()->setTitle('Auteur');

        $loan = '35%';

        return $this->render('stat/index.html.twig', [
            'piecharttopbook' => $pieChartTopBook,
            'piechartbadbook' => $pieChartBadBook,
            'barTopAutor' => $barTopAutor,
            'barBadAutor' => $barBadAutor,
            'loan' => $loan
        ]);
    }
}
