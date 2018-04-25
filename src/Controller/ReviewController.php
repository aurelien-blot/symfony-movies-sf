<?php

namespace App\Controller;

use App\Form\ReviewType;
use App\Entity\Review;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReviewController extends Controller
{
    /**
     * @Route("/review/{id}/create", name="review_create", requirements={ "id": "\d+" })
     */
    public function createReview(int $id, Request $request){

        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);

        $review->setDateCreated(new \DateTime());
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            $this->addFlash("success", "Votre review a bien été ajoutée, bâtard !");
            return $this->redirectToRoute("movie_detail", ['id' => $id]);
        }

        return $this->render("review/create.html.twig", [
            "form" => $form->createView(),
            "id" => 3
        ] );
    }
}