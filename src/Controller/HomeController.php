<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository, CalendarRepository $calendarRepository)
    {
        $articles = $articleRepository->findAll();
        $event = $calendarRepository->findAll();
        // dd($event);
        $rdvs = [];
        foreach ($event as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getFin()->format('Y-m-d H:i:s'),
                'description' => $event->getDescription(),
                'title' => $event->getTitle(),
                'textColor' => $event->getTextColor(),
                'borderColor' => $event->getBorderColor(),
                'backgroundColor' => $event->getBackgroundColor(),
                'allDay' => $event->getAllDay(),

            ];
        }
        $data = json_encode($rdvs);
        //dd($event);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'event' => $data,
            'articles' => $articles,

        ]);
    }
}
