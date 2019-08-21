<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        // Crear formulario
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        // Vamos a vincular al objeto con el fomrulario
        // Rellenar el objeto con lso datos del formulario
        $form->handleRequest($request);

        // Comprobamos si el formulario ha sido enviado
        if ($form->isSubmitted() && $form->isValid()){
            // Modificamos el objeto para guardarlo
            $user->setRole('ROLE_USER');
            // $date_now = (new \DateTime())->format('d-m-Y H:i:s');
            // $user->setCreatedAt($date_now);
            $user->setCreatedAt(new \DateTime('now'));

            // Ciframos la contraseña
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            // Guardamos al USuario
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            // var_dump($user);

            return $this->redirectToRoute('tasks');

        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Metodos para el login
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUserName
        ]);
    }
}
