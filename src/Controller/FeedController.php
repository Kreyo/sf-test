<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FeedController extends AbstractController
{
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $number = random_int(0, 100);

        return $this->render('feed/index.html.twig', [
            'number' => $number,
        ]);
    }
}

