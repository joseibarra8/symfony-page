<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/estudiante/{variable}", name="estudiante")
     */
    public function estudiante($variable){
           /* return new Response(sprintf(
            	"Portal del estudiante: %s", $variable
            ));*/
        $comentarios = [
                'comentario1',
                'comentario2',
                'comentario3'
        ];
        $matriculas = [
        		'U991234',
        		'U995678',
        		'U999876',
        		'U999879'
        ];
       
        return $this->render('home/show.html.twig',[
 			'titulo' => ucwords(str_replace('-', ' ', $variable)),
 			'contenido' => ucwords(str_replace('-', ' ', 'Está es una prueba symfony')),
 			'comentarios' =>  $comentarios,
 			'matriculas' => $matriculas
        ]);

    }

     /**
     * @Route("/contacto/", name="contacto")
     */
    public function contacto(){
    	return $this->render('contacto/contacto.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

  
}
