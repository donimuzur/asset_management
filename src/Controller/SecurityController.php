<?php

namespace App\Controller;

use App\Entity\AssetUser;
use App\Utility\PasswordHash;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
     
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

     /**
     * @Route("/change_password", name="user_change_password")
     */
    public function change_password(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $old_pwd = $request->get('old_password'); 
        $new_pwd = $request->get('new_password'); 
        $new_pwd_confirm = $request->get('new_password_confirm');
        $submittedToken = $request->request->get('_token');
        if ($request->isMethod('POST') && $this->isCsrfTokenValid('Security', $submittedToken)) {
            $user = $this->getUser();
            $passwordHash = new PasswordHash();
            $checkPass = $passwordHash->verify($old_pwd, $user->getPassword());
            if($old_pwd !=  $new_pwd)
            {
                $this->addFlash(
                    'danger',
                    'The Password you entered did not match'
                );
                
                return $this->redirectToRoute('user_change_password');
            }
            if($checkPass === true) {
                $entityManager = $this->getDoctrine()->getManager();
                $userToUpdate = $entityManager->getRepository(AssetUser::class)->findOneBy(['Id' =>  $user->getId()]);
                $userToUpdate->setUserPassword($new_pwd);
                $entityManager->flush();
                
                return $this->redirectToRoute('app_logout');
            } else {
                $this->addFlash(
                    'danger',
                    'Old Password is not valid'
                );
                return $this->redirectToRoute('user_change_password');
            }
        }
        return $this->render('security/changepassword.html.twig');
    }
}
