<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_inicio")
     */
    public function homepage()
    {
        return $this->render('inicio/inicio.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/estudiante/{variable}", name="app_estudiante")
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
        		'U999879',
        		'U999867',
        		'U999868',
        		'U999869',
        		'U9998670',
        		'U9998671',
        		'U9998672',
        		'U9998673',
        		'U9998674',
        ];

        return $this->render('estudiante/show.html.twig',[
 			'titulo' => ucwords(str_replace('-', ' ', $variable)),
 			'contenido' => ucwords(str_replace('-', ' ', 'Está es una prueba symfony')),
 			'comentarios' =>  $comentarios,
 			'matriculas' => $matriculas,
 			'variable' => $variable
        ]);

    }

     /**
     * @Route("/contacto/", name="app_contacto")
     */
    public function contacto(){
    	return $this->render('contacto/contacto.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
    * @Route("/estudiante/{variable}/heart",name="article_toggle_heart",methods={"POST"})
    */
    public function toggleArticleHeart($variable){
    	// TODO - actually heart/unheart the article!

    	return new JsonResponse(['corazon' => rand(5,100)]);
    }

  
}
