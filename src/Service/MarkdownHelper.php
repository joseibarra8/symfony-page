<?php
namespace App\Service;

use Michelf\MarkdownInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Psr\Log\LoggerInterface;

class MarkdownHelper
{
	private $cache;
    private $markdown;
    private $logger;

    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown, LoggerInterface $markdownLogger)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger=$markdownLogger;
    }

	function parse(string $source): string
	{
		if (stripos($source, 'bacon') !== false) {
            $this->logger->info('Se encontró la palabra bacon en el textooo!');
        }
		$item = $this->cache->getItem('ula_'.md5($source));
		if (!$item->isHit()) {//verifica que la clave no esté en caché
			$item->set($this->markdown->transform($source));
            $this->cache->save($item);
		}
        return $item->get();//obtiene el valor de caché
	}

	function suma(int $var1, int $var2): int
	{
       $suma = $var1 + $var2;
       return $suma;
	}
}