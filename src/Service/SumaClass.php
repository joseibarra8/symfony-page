<?php
namespace App\Service;
use App\Service\OperacionesClass;
use Psr\Log\LoggerInterface;

class SumaClass extends OperacionesClass{
	public static $variable = 4;
	private $logger;


	public function __construct(LoggerInterface $markdownLogger)
    {
        $this->logger=$markdownLogger;
    }

	public function operar(): int
	{
		if(parent::CONS == 1){
             $this->logger->info('LA CONSTANTE VALE UNO');
		}
		return $this->resultado = $this->valor1 + $this->valor2 + parent::CONS + self::$variable;
	}
}