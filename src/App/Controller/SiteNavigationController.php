<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\AboutMapper;
use App\ModelMapper\PageMapper;
use App\ModelMapper\PageLookupMapper;

class SiteNavigationController
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
        $this->logger->debug("Area:Navigation Action:getAllPages Client:" . $_SERVER['REMOTE_ADDR']);
        $mapper = new PageLookupMapper($this->db);
        $entity = $mapper->readAll();     
        return $this->view->render($response, 'index.html.twig', array('entity' => $entity));
    }

    public function getPagesByCategorySlug(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getPagesByCategorySlug Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['slug']);        
        $mapper = new PageLookupMapper($this->db);
        $entity = $mapper->readAllByCategory($args['slug']);     
        return $this->view->render($response, 'category.html.twig', array('entity' => $entity));
    }

    public function getPagesByKeywords(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getPagesByKeywords Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['keywords']);        
        $mapper = new PageLookupMapper($this->db);
        $entity = $mapper->readAllByKeywords($args['keywords']);     
        return $this->view->render($response, 'search.html.twig', array('entity' => $entity));
    }

    public function getPageBySlug(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getPageBySlug Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['slug']);
        $mapper = new PageMapper($this->db);
        $entity = $mapper->read($args['slug']);     
        return $this->view->render($response, 'page.html.twig', array('entity' => $entity));
    }

    public function getAboutPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getAboutPage Client:" . $_SERVER['REMOTE_ADDR']);
        $mapper = new AboutMapper($this->db);
        $entity = $mapper->read();     
        return $this->view->render($response, 'about.html.twig', array('entity' => $entity));
    }
}