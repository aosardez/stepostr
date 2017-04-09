<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\AccountMapper;

class ContributorController
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

    public function getAllContributors(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getAllContributors Client:" . $_SERVER['REMOTE_ADDR']);
        $mapper = new AccountMapper($this->db);
        $entity = $mapper->readAll();     
        return $this->view->render($response, 'admin\contributor.list.html.twig', array('entity' => $entity));
    }

    public function getContributorById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getContributorById Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $mapper = new AccountMapper($this->db);
        $entity = $mapper->read($args['id']);     
        return $this->view->render($response, 'admin\contributor.html.twig', array('entity' => $entity));
    }

    public function postContributor(RequestInterface $request, ResponseInterface $response, $args)
    {
        // to follow
    }
}
