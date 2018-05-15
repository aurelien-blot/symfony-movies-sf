<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    /**
     * @Route("/api/v1/movies/", name="api_movies_list", methods={"GET"})
     */
    public function moviesList(Request $request)
    {
        $movieRep = $this->getDoctrine()->getRepository(Movie::class);

        $q = $request->query->get("q");
        $movies = $movieRep->search($q);

        return $this->json(
            [
                "status" => "ok",
                "message" => "",
                "data" => $movies
            ]
        );
    }

    /**
     * @Route("/api/v1/movies/{id}", name="api_movies_detail", methods={"GET"})
     */
    public function moviesDetail(int $id, Request $request)
    {
        $movieRep = $this->getDoctrine()->getRepository(Movie::class);
        $movie = $movieRep->getMovieAndReviews($id);
        //var_dump($movie);

        /*$reviewRep = $this->getDoctrine()->getRepository(Review::class);
        $reviews = $reviewRep->findBy(
            ["movie" => $movie],
            ["dateCreated" => "DESC"]
        );*/

        return $this->json([
                "status" => "ok",
                "message" => "",
                "data" => $movie
            ]
        );
    }
}
