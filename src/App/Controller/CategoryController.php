<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\CategoryMapper;

class CategoryController
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

    public function getAllCategories(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getAllCategories Client:" . $_SERVER['REMOTE_ADDR']);
        $mapper = new CategoryMapper($this->db);
        $entity = $mapper->readAll();     
        return $this->view->render($response, 'admin\category.list.html.twig', array('entity' => $entity));
    }

    public function getCategoryById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getCategoryById Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $mapper = new CategoryMapper($this->db);
        $entity = $mapper->read($args['id']);     
        return $this->view->render($response, 'admin\category.html.twig', array('entity' => $entity));
    }

    public function postCategory(RequestInterface $request, ResponseInterface $response, $args)
    {
        // to follow
    }
}
