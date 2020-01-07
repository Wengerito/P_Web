<?php

namespace App\Controller;

use App\Entity\Book;
use Proxies\__CG__\App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/book/{id}", name="book_show")
     */
    public function show($id)
    {
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        return $this->render('king_book/show.html.twig',['book' => $book]);
    }

    /**
     * @Route("/form", name="book_form")
     */
    public function new(Request $request)
    {
        // creates a book object
        $book = new Book();

        $form = $this->createFormBuilder($book)
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('category', EntityType::class, ['class'=>Category::class,'choice_label' => function ($category) {
                return $category->getName();
            },'label' => 'Catégorie'])
            ->add('numberOfPages', NumberType::class, ['label' => 'Nombre de page'])
            ->add('extract', TextareaType::class, ['label' => 'Extrait'])
            ->add('abstract', TextareaType::class, ['label' => 'Résumé'])
            ->add('author', TextType::class, ['label' => 'Auteur'])
            ->add('editor', TextType::class, ['label' => 'Éditeur'])
            ->add('year', NumberType::class, ['label' => 'Année'])
            ->add('score', NumberType::class, ['label' => 'Score'])
            ->add('coverImage', UrlType::class, ['label' => 'Couverture'])
            ->add('save', SubmitType::class, ['label' => 'Create Book'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
            $book = $form->getData();
            $book->setUser($this->getUser());

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }

        return $this->render('king_book/new.html.twig', [
            'form' => $form->createView(),
        ]);
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

    /**
     * @Route("/books", name="books")
     */
    public function showAllBooks()
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();       
        return $this->render('king_book/books.html.twig',['books' => $books,'categories' => $categories]);
    }
}
