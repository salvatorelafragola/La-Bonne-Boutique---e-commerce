<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Adress;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAdresseController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/moncompte/adresses", name="account_adresse")
     */
    public function index(): Response
    {
        return $this->render('account/adresse.html.twig');
    }

     /**
     * @Route("/moncompte/ajouter-adresse", name="add_adresse")
     */
    public function add(Cart $cart,Request $request)
    {
        $address = new Adress();
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $address->setUser($this->getUser());
            $this->entityManager->persist($address);
            $this->entityManager->flush();
            if ($cart->get()){
                return $this->redirectToRoute('order');
            }
            return $this->redirectToRoute('account_adresse');
        }

        return $this->render('account/adresse_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/moncompte/modifier-adresse/{id}", name="edit_adresse")
     */
    public function edit(Request $request, $id)
    {
        $address = $this->entityManager->getRepository(Adress::class)->findOneById($id);
        $form = $this->createForm(AddressType::class, $address);

        if (!$address || $address->getUser() != $this->getUser())
        {
            return $this->redirectToRoute('account_adresse');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->flush();
            return $this->redirectToRoute('account_adresse');
        }
        return $this->render('account/adresse_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

         /**
     * @Route("/moncompte/effacer-adresse/{id}", name="delete_adresse")
     */
    public function delete($id)
    {
        $address = $this->entityManager->getRepository(Adress::class)->findOneById($id);

        if ($address || $address->getUser() == $this->getUser())
        {
            $this->entityManager->remove($address);
            $this->entityManager->flush();
        }
      return $this->redirectToRoute('account_adresse');

    }
}
