<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrerController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/inscription", name="registrer")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user) ;
        //analizza la richiesta
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if (!$search_email){

                //per inviare al database:
                //stock la pass nella variabile per criptarla
                $password = $encoder->encodePassword($user, $user->getPassword());
                //dopodiche gli diciamo di iniettare la password nell oggetto user
                $user->setPassword($password);
                $this->entityManager->persist($user);
                //esegui la request
                $this->entityManager->flush();
               
                $mail = new Mail();
                $content = "Bonjour ". $user->getFirstname() . '<br> Bienvenue sur la prémiere boutique de mode en France';
                $mail->send($user->getEmail(), $user->getFirstname(), 'Bienvenue sur La Bonne Boutique', $content);

                $notification = 'Votre iscription s est correctement déroulé.';

            } else {

                $notification = 'L inscription a échoué';

            }

          

        }
        return $this->render('registrer/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
