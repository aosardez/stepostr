<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Controller\BaseController;
use App\Model\Category;
use App\ModelMapper\CategoryMapper;
use App\ModelMapper\SiteDetailMapper;

class CategoryController extends BaseController
{
    public function getAllCategories(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Category Action:getAllCategories Client:" . $_SERVER['REMOTE_ADDR']);
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll();      
        return $this->view->render($response, 'admin\category.list.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $categories, 'currentTitle' => 'Categories', 'isCategories' => true));
    }

    public function getCategoryForCreate(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Category Action:getCategoryForCreate Client:" . $_SERVER['REMOTE_ADDR']);
        $data = array('id' => 0);
        $category = new Category($data);
        return $this->view->render($response, 'admin\category.html.twig', array('siteDetail' => $this->getSiteDetail(), 'category' => $category, 'currentTitle' => 'Add Category', 'isCategories' => true));
    }

    public function getCategoryById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Category Action:getCategoryById Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $categoryMapper = new CategoryMapper($this->db);
        $category = $categoryMapper->read($args['id']);
        return $this->view->render($response, 'admin\category.html.twig', array('siteDetail' => $this->getSiteDetail(), 'category' => $category, 'currentTitle' => 'Edit Category', 'isCategories' => true));
    }

    public function getCategoryByIdForDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Category Action:getCategoryByIdForDelete Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $categoryMapper = new CategoryMapper($this->db);
        $categoryMapper->delete($args['id']);     
        $categories = $categoryMapper->readAll();        
        return $this->view->render($response, 'admin\category.list.html.twig', array('siteDetail' => $this->getSiteDetail(), 'categories' => $categories, 'currentTitle' => 'Categories', 'isCategories' => true));
    }

    public function postCategory(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Category Action:postCategory Client:" . $_SERVER['REMOTE_ADDR']);
        $data = $request->getParsedBody();
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));
        if (array_key_exists ('published', $data)) {
            $data['published'] = $data['published'] == "on" ? 1 : 0;
        }
        else {
            $data['published'] = 0;
        }
        if ($data['dateCreated'] == "") {
            $data['dateCreated'] = date('Y-m-d H:i:s');
        }
        $data['dateModified'] = date('Y-m-d H:i:s');
        $category = new Category($data);
        $categoryMapper = new CategoryMapper($this->db);
        if ($category->getId() > 0){
            $categoryMapper->update($category);
        }
        else {
            $id = $categoryMapper->create($category);
            $category->setId($id);
        }
        return $this->view->render($response, 'admin\category.html.twig', array('siteDetail' => $this->getSiteDetail(), 'category' => $category, 'currentTitle' => 'Edit Category', 'isCategories' => true));     
    }
}
