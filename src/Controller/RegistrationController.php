<?php
namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [ 'allow_extra_fields' => true ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEmail($request->request->get('email'));
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/validate-email/{email}", name="ajax_email_validation")
     */
    public function validateEmail($email)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneByEmail($email);

        return $user ?
            new Response('User already exists :(', 400) :
            new Response('You can use that email!', 200);
    }
}