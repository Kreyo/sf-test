<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $feed = 'https://www.theregister.co.uk/software/headlines.atom';
        $arrayFeed = (array) simplexml_load_file($feed);

        return $this->render('feed/index.html.twig', [
            'feed' => $arrayFeed['entry'],
        ]);
    }
}

