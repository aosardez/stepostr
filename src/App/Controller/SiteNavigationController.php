<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\AboutMapper;
use App\ModelMapper\CategoryMapper;
use App\ModelMapper\PageMapper;
use App\ModelMapper\PageDigestMapper;
use App\ModelMapper\SiteDetailMapper;

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
        $pageMapper = new PageDigestMapper($this->db);
        $pages = $pageMapper->readAll();     
        return $this->view->render($response, 'index.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'pages' => $pages));
    }

    public function getPagesByCategorySlug(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getPagesByCategorySlug Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['slug']);
        $pageMapper = new PageDigestMapper($this->db);
        $pages = $pageMapper->readAllByCategory($args['slug']);     
        return $this->view->render($response, 'category.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'pages' => $pages, 'currentTitle' => $pages[0]->getCategoryName(), 'category' => $pages[0]->getCategoryName()));
    }

    public function getPagesByKeywords(RequestInterface $request, ResponseInterface $response, $args)
    {   
        $this->logger->debug("Area:Navigation Action:getPagesByKeywords Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $_GET['keywords']);
        $pageMapper = new PageDigestMapper($this->db);  
        $pages = $pageMapper->readAllByKeywords($_GET['keywords']);     
        return $this->view->render($response, 'search.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'pages' => $pages, 'currentTitle' => 'Search results for "' . $_GET['keywords'] . '"', 'keywords' => $_GET['keywords']));
    }

    public function getPageBySlug(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getPageBySlug Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['slug']);
        $pageMapper = new PageMapper($this->db);
        $page = $pageMapper->read($args['slug']);
        $pageDigestMapper = new PageDigestMapper($this->db);
        $pageDigest = $pageDigestMapper->readBySlug($args['slug']);
        return $this->view->render($response, 'page.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'page' => $page, 'pageDigest' => $pageDigest, 'currentTitle' => $pageDigest->getTitle(), 'category' => $pageDigest->getCategoryName()));
    }

    public function getAboutPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getAboutPage Client:" . $_SERVER['REMOTE_ADDR']);
        $aboutMapper = new AboutMapper($this->db);
        $about = $aboutMapper->read();     
        return $this->view->render($response, 'about.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'about' => $about, 'currentTitle' => 'About', 'isAbout' => true));
    }

    private function getSiteDetail()
    {
        $siteDetailMapper = new SiteDetailMapper($this->db);
        $siteDetail = $siteDetailMapper->read();
        return $siteDetail;
    }

    private function getCategories()
    {
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll();   
        return $categories;     
    }
}