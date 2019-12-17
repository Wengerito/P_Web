<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="create_book")
     */
    public function createBook(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $book = new Book();
        $book->setTitle('titre');
        $book->setCategory('categorie');
        $book->setNumberOfPages(1000);
        $book->setExtract('lien vers');
        $book->setAbstract('résumé');
        $book->setAuthor('Auteur');
        $book->setEditor('Editeur');
        $book->setYear(1999);
        $book->setScore(3.5);
        $book->setCoverImage('image');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id ' . $book->getId());
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
        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }   
    
}
