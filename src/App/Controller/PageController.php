<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\PageMapper;

class PageController
{
    private $logger;
    private $view;
    private $db;

    public function __construct(LoggerInterface $logger, Twig $view, \PDO $db)
    {
        $this->logger   = $logger;
        $this->view   = $view;
        $this->db   = $db;
    }    

    public function getAllPages(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getAllPages Client:" . $_SERVER['REMOTE_ADDR']);
        $mapper = new PageMapper($this->db);
        $entity = $mapper->readAll(false);     
        return $this->view->render($response, 'admin\page.list.html.twig', array('entity' => $entity));
    }

    public function getPageById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getPageById Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $mapper = new PageMapper($this->db);
        $entity = $mapper->read($args['id']);     
        return $this->view->render($response, 'admin\page.html.twig', array('entity' => $entity));
    }

    public function postPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        // to follow
    }
}
