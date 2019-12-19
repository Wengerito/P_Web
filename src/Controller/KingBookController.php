<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route ("/Form", name="Form")
     * 
     * Affiche la page contact
     */
    public function addBook()
    {
        return $this->render('king_book/new.html.twig');
    }

    /**
     * @Route ("/login", name="login")
     * 
     * Affiche la page de connexion
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('king_book/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/", name="king_book")
     */
    public function showLastBooks()
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findBy(array(), array('id' => 'desc'), 6, 0);
                
        return $this->render('king_book/index.html.twig',['book' => $books]);
                      
    } 
}
