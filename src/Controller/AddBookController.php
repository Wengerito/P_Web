<?php
// src/Controller/AddBookController.php
namespace App\Controller;

use App\Entity\Book;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;


class AddBookController extends AbstractController
{
    /**
     * @Route("/Form", name="book_form")
     */
    public function new(Request $request)
    {
        // creates a book object
        $book = new Book();

        $form = $this->createFormBuilder($book)
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('category', TextType::class, ['label' => 'Catégorie'])
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

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_show',['id' => $book->getId()]);
    }

            return $this->render('king_book/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}