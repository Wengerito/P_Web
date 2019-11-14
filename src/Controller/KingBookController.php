<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KingBookController extends AbstractController
{
    /**
     * @Route("/", name="king_book")
     */
    public function index()
    {
        return $this->render('king_book/index.html.twig', [
            'controller_name' => 'KingBookController',
        ]);
    }

    /**
     * @Route ("/books", name="books")
     * 
     * Affiche la page des ouvrages
     */
    public function books()
    {
        return $this->render('king_book/books.html.twig');
    }

    /**
     * @Route ("/contact", name="contact")
     * 
     * Affiche la page contact
     */
    public function contact()
    {
        return $this->render('king_book/contact.html.twig');
    }

    /**
     * @Route ("/login", name="login")
     * 
     * Affiche la page de connexion
     */
    public function login()
    {
        return $this->render('king_book/login.html.twig');
    }
}
