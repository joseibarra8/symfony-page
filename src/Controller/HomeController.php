<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;//Permite guardar y recuperar datos de la base de datos
use App\Entity\Article;//class de la tabla

use App\Service\MarkdownHelper;
use App\Service\SumaClass;
use Nexy\Slack\Client;

use App\Repository\ArticleRepository; //pARA OBTENER CONSULTAS PERSONALIZADAS PASANDO

use Twig\Environment;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_inicio")
     */
    public function homepage(EntityManagerInterface $recuperadatosDB)
    {
    	$repository = $recuperadatosDB->getRepository(Article::class);
    	$articles = $repository->findAllPublishedOrderedByNewest();// slug es el campo en la BD y $variable el valor pasado
    	if (!$articles) {
            throw $this->createNotFoundException('No se encontraron articulos');
        }

        return $this->render('inicio/inicio.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/estudiante/{variable}", name="app_estudiante")
     */
    public function estudiante($variable, MarkdownHelper $miclase, SumaClass $sumar, Client $slack, EntityManagerInterface $recuperadatosDB){
           /* return new Response(sprintf(
            	"Portal del estudiante: %s", $variable
            ));*/
      
      
        if ($variable === 'khaaaaaan') {
        	$message = $slack->createMessage()
                ->from('Khan')
                ->withIcon(':ghost:')
                ->setText('Ah, Kirk, my old friend...');
            $slack->sendMessage($message);
        }
        $repository = $recuperadatosDB->getRepository(Article::class);
         /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $variable]);// slug es el campo en la BD y $variable el valor pasado
         if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $variable));
        }
        //dump($article);die;

        $comentarios = [
                'comentario1',
                'comentario2',
                'comentario3'
        ];
        $matriculas = [
        		'U9912347',
        		'U9956780',
        		'U9998760',
        		'U9998790',
        		'U9998670',
        		'U9998680',
        		'U9998690',
        		'U9998670',
        		'U9998671',
        		'U9998672',
        		'U9998673',
        		'U9998674',
        ];

        $var1 =5;
        $var2 =15;

        $suma = $miclase->suma($var1,$var2);


        /////////operaciones

         $sumar->cargar1(1000);
         $sumar->cargar2(150);
         $sumar->operar();
         $res = $sumar->imprimirResultado();
         

        //////////////////



         $articleContent = <<<EOF
###Spicy $suma $res
**jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi *landjaeger* cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non *cupim*.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. **Consectetur** ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. **Cow ut reprehenderit**, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore [ULA](http://ula.edu.mx "Univarsidad Latinoamericana") esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing.

Pig hamburger pork belly enim. Do porchetta minim capicola irure **pancetta chuck**
fugiat.

> La vida es muy corta para aprender Alemán. -Tad Marburg

 * Un elemento en una lista no ordenada
 * Otro elemento en una lista
 * Otro elemento en una lista
 * Otro elemento en una lista
 * Otro elemento en una lista
 * Otro elemento en una lista
 * Otro elemento en una lista
 * Otro elemento en una lista
 * Otro elemento en una lista
 * Otro elemento en una lista

1. Elemento en una lista enumerada u ordenada.
2. Otro elemento
3. Otro elemento
bacon

EOF;
        //dump($cache);die;
		

		$articleContent = $miclase->parse($articleContent);
        return $this->render('estudiante/show.html.twig',[
 			'titulo' => ucwords(str_replace('-', ' ', $variable)),
 			'contenido' => ucwords(str_replace('-', ' ', 'Está es una prueba symfony')),
 			'comentarios' =>  $comentarios,
 			'matriculas' => $matriculas,
 			'variable' => $variable,
 			'articleContent' => $articleContent,
 			'articles'=>$article,
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
    public function toggleArticleHeart($variable,LoggerInterface $login){
    	// TODO - actually heart/unheart the article!

	    $entityManager = $this->getDoctrine()->getManager();
	    $product = $entityManager->getRepository(Article::class)->findOneBy(['slug' => $variable]);

	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$variable
	        );
	    }

	    $product->incrementHeartCount();
	    // $product->setHeartCount($product->getHeartCount() + 1);
	    $entityManager->flush();

			$login->info('Se ejecuta función');
	    	//return new JsonResponse(['corazon' => rand(5,100)]);
	    	return new JsonResponse(['corazon' => $product->getHeartCount()]);
	    }



  
}
