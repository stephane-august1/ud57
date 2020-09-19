<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Form\MiniatureType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        //  dd($articles);
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article, $id): Response
    {
        $myid = $id;
        $url = $request->getRequestUri();
        // dd($request);
        //dd($id);
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);


        // dd($id);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($url);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }
    /**
     * @Route("/modifiimgclass/{id}", name="article_modifi", methods={"POST"})
     */
    public function modifi_classimg(ManagerRegistry $manager, Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $idselect = $article->getId();
        $articles = $articleRepository->find($idselect);
        $oldstatus = $articles->getImageplace();
        // dd($oldstatus);
        $newstatus = $request->request->get('imageplace');
        $status = $request->request->get('status');
        dd($status);
        dd($request->request->get('newstatus'));
        //$url = $request->getRequestUri();
        $url = $request->request->get('url');
        //  dd($newstatus);
        //dd($id);

        $entityManager = $this->getDoctrine()->getManager();
        $response = new Response(
            json_encode(
                array(
                    'url' => $url,
                    'id' => $idselect,

                    // 'newstatus' => $newstatus,




                )
            )
        );
        // $articles->setImageplace($newstatus);
        $entityManager->persist($article);
        $entityManager->flush();
        $response->header->set('Content-Type', 'html/text');
        return $response;

        //$this->getDoctrine()->getManager()->flush();

        //  return $this->redirect($url);


        return $response;
    }
}
