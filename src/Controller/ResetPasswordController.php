<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/mot-de-passe-oublie", name="reset_password")
     */
    public function index(Request $request)
    {
        if ($this->getUser()){
            return $this->redirectToRoute('home');
        }

        //request serve a ottenere un input di un form
        if ($request->get('email')){
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
            
            if ($user) {
                // I: enregistrer en base la demande de reset_password avec user, token et createdat
                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new DateTime());
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                // II: envoyer un email à l'utilisateur avec un mien lui permettant de mettre a jour son mot de passe
                $url = $this->generateUrl('update_password', [
                    'token' =>  $reset_password->getToken()
                ]);

                $content = "Bonjour ".$user->getFirstname()."<br>Vous avez demandé à réinitialiser votre mot de passe sur le site La Bonne Boutique <br><br>";
                $content .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='".$url."'> mettre à jour votre mot de passe.</a>";
               
                $mail = new Mail();
                $mail->send($user->getEmail(), $user->getFirstname().' '.$user->getLastname(), 'Réinitialiser votre mot de passe sur la Bonne Boutique', $content);
            
                $this->addFlash('notice', 'Vous allez recevoir les instructions pour changer mdp dans une mail.');

            } else {
                
                $this->addFlash('notice', 'Cette adresse email est inconnue.');
            
            }
        }

        return $this->render('reset_password/index.html.twig');
    }

        /**
     * @Route("/modifier-mot-de-passe/{token}", name="update_password")
     */
    public function update(Request $request, $token, UserPasswordEncoderInterface $encoder)
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);

        if (!$reset_password){
            return $this->redirectToRoute('reset_password');
        } 
        //Vérifier si le createdAt = now - 3h
        $now = new DateTime();
        if ($now > $reset_password->getCreatedAt()->modify('+ 3 hour')){

            $this->addFlash('notice', 'Votre demande de mot de passe a expiré. Merci de la renouveller.');
            return $this->redirectToRoute('reset_password');
        }

        //rendre une vue avec mdp et confirmez le mdp
       $form = $this->createForm(ResetPasswordType::class);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()){

            $new_pwd = $form->get('new_password')->getData();

            //Encodage mdp
            $password = $encoder->encodePassword($reset_password->getUser(), $new_pwd);
            $reset_password->getUser()->setPassword($password);

            // Stockage en bdd
            $this->entityManager->flush();


            $this->addFlash('notice', 'Votre mot de passe a ete bien mis a jour');
            return $this->redirectToRoute('app_login');
        
       }

        return $this->render('reset_password/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
