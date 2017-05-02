<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Controller\BaseController;
use App\ModelMapper\AboutMapper;
use App\ModelMapper\CategoryMapper;
use App\ModelMapper\PageMapper;
use App\ModelMapper\PageDigestMapper;
use App\ModelMapper\SiteDetailMapper;

class SiteNavigationController extends BaseController
{
    public function getAllPages(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getAllPages Client:" . $_SERVER['REMOTE_ADDR']);
        $pageMapper = new PageDigestMapper($this->db);
        $pages = $pageMapper->readAll(1);     
        return $this->view->render($response, 'index.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'navSession' => $this->getNavSession(null, 'Home', null), 'pages' => $pages));
    }

    public function getPagesByCategorySlug(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getPagesByCategorySlug Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['slug']);
        $pageMapper = new PageDigestMapper($this->db);
        $pages = $pageMapper->readAllByCategory($args['slug']);
        $categories = $this->getCategories();
        $category = $this->getCategoryBySlug($categories, $args['slug']);
        return $this->view->render($response, 'category.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $categories, 'navSession' => $this->getNavSession($category->getName(), 'Categories', $category->getName()), 'pages' => $pages));
    }

    public function getPagesByKeywords(RequestInterface $request, ResponseInterface $response, $args)
    {   
        $this->logger->debug("Area:Navigation Action:getPagesByKeywords Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $_GET['keywords']);
        $pageMapper = new PageDigestMapper($this->db);  
        $pages = $pageMapper->readAllByKeywords($_GET['keywords']);     
        return $this->view->render($response, 'search.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'navSession' => $this->getNavSession('Search results for "' . $_GET['keywords'] . '"', 'Search', null), 'pages' => $pages, 'keywords' => $_GET['keywords']));
    }

    public function getPageBySlug(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getPageBySlug Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['slug']);
        $pageMapper = new PageMapper($this->db);
        $page = $pageMapper->read($args['slug']);
        $pageDigestMapper = new PageDigestMapper($this->db);
        $pageDigest = $pageDigestMapper->readBySlug($args['slug']);
        return $this->view->render($response, 'page.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'navSession' => $this->getNavSession($pageDigest->getTitle(), 'Pages', $pageDigest->getCategoryName()), 'page' => $page));
    }

    public function getAboutPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Navigation Action:getAboutPage Client:" . $_SERVER['REMOTE_ADDR']);
        $aboutMapper = new AboutMapper($this->db);
        $about = $aboutMapper->read();     
        return $this->view->render($response, 'about.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $this->getCategories(), 'navSession' => $this->getNavSession('About', 'About', null)));
    }

    private function getCategories()
    {
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll();   
        return $categories;     
    }

    private function getCategoryBySlug($categories, $slug)
    {
        foreach ($categories as $category) {
            if ($category->getSlug() == $slug) {
                return $category;
            }
        }        
    }
}