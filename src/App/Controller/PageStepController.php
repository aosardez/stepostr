<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Controller\BaseController;
use App\Model\PageStep;
use App\ModelMapper\CategoryMapper;
use App\ModelMapper\PageMapper;
use App\ModelMapper\PageDigestMapper;
use App\ModelMapper\PageStepMapper;
use App\ModelMapper\SiteDetailMapper;

class PageStepController extends BaseController
{
    public function getPageStepForCreate(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:PageStep Action:getPageForCreate Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = array('id' => 0, 'pageId' => $_GET['pageId'], 'order' => $_GET['order'] + 1);        
        $pageStep = new PageStep($data);
        $pageMapper = new PageMapper($this->db);
        $page = $pageMapper->read($_GET['pageId']);
        return $this->view->render($response, 'admin\pagestep.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'page' => $page, 'pageStep' => $pageStep));
    }

    public function getPageStepById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:PageStep Action:getPageStepById Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $pageStepMapper = new PageStepMapper($this->db);     
        $pageStep = $pageStepMapper->read($_GET['id']);
        $pageMapper = new PageMapper($this->db);
        $page = $pageMapper->read($_GET['pageId']);
        return $this->view->render($response, 'admin\pagestep.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'page' => $page, 'pageStep' => $pageStep));
    }

    public function getPageStepByIdForDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:PageStep Action:getPageByIdForDelete Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $pageStepMapper = new PageStepMapper($this->db);
        $pageStepMapper->delete($_GET['id']);     
        $pageMapper = new PageMapper($this->db);
        $page = $pageMapper->read($_GET['pageId']);
        $pageDigestMapper = new PageDigestMapper($this->db);
        $pageDigest = $pageDigestMapper->readBySlug($page->getSlug(), 0);
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll();    
        return $this->view->render($response, 'admin\page.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'categories' => $categories, 'page' => $page, 'pageDigest' => $pageDigest));
    }

    public function postPageStep(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:PageStep Action:postPage Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = $request->getParsedBody();
        $pageStep = new PageStep($data);
        if (isset($_FILES["image"]) && $_FILES["image"]["name"] != null) {
            $target_dir = "/uploads/images/" . date('Y-m-d') . "/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $this->uploadFile("image", $target_dir, $target_file);
            $pageStep->setImagePath($target_file);
        }
        $pageStepMapper = new PageStepMapper($this->db);
        if ($pageStep->getId() > 0){
            $pageStepMapper->update($pageStep);
        }
        else {
            $pageStepMapper->create($pageStep);
        }    
        $pageMapper = new PageMapper($this->db);
        $page = $pageMapper->read($pageStep->getPageId());
        $pageDigestMapper = new PageDigestMapper($this->db);
        $pageDigest = $pageDigestMapper->readBySlug($page->getSlug(), 0);
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll();    
        return $this->view->render($response, 'admin\page.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'categories' => $categories, 'page' => $page, 'pageDigest' => $pageDigest));
    }

    private function uploadFile($field, $target_dir, $target_file) 
    {
        if (!file_exists(SITE_ROOT.$target_dir)) {
            mkdir(SITE_ROOT.$target_dir, 0777, true);
        }
        move_uploaded_file($_FILES[$field]["tmp_name"], SITE_ROOT.$target_file);
        chmod(SITE_ROOT.$target_file, 0777);
    }
}
