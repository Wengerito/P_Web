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
            ->add('title', TextType::class)
            ->add('category', TextType::class)
            ->add('numberOfPages', IntegerType::class)
            ->add('extract', TextType::class)
            ->add('abstract', TextType::class)
            ->add('author', TextType::class)
            ->add('editor', TextType::class)
            ->add('year', IntegerType::class)
            ->add('score', NumberType::class)
            ->add('coverImage', TextType::class)
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