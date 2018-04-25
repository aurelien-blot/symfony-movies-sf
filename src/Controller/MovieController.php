<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Repository\MovieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $movieRep = $this->getDoctrine()->getRepository(Movie::class);
        //$movies = $movieRep->findAll();
        $movies = $movieRep->findBy([], ["rating" => "DESC"], 50);

        return $this->render("movie/home.html.twig", ["movies" => $movies]);
    }

    /**
     * @Route("/movie/{id}", name="movie_detail", requirements={ "id": "\d+" })
     */
    //public function detail(Movie $movie){
    public function detail(int $id){

        $movieRep = $this->getDoctrine()->getRepository(Movie::class);
        $movie = $movieRep->findOneBy( ["id" => $id]);
        //var_dump($movie);

        $reviewRep = $this->getDoctrine()->getRepository(Review::class);
        $reviews = $reviewRep->findBy(["movie" => $movie]);



        return $this->render("movie/detail.html.twig", [ "id" => $id , "movie" => $movie, "reviews" => $reviews ]);
    }
}

