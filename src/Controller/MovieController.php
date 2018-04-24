<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    /**
     * @Route("/movie", name="movie")
     */
    public function index()
    {
        return new Response('caca');
    }

    /**
     * @Route("/movie/{id}", name="movie_detail", requirements={ "id": "\d+" })
     */
    public function detail(int $id){
    	return new Response('page detail ' . $id);
    }
}

