<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Controller\BaseController;
use App\Model\Page;
use App\ModelMapper\CategoryMapper;
use App\ModelMapper\PageMapper;
use App\ModelMapper\PageDigestMapper;
use App\ModelMapper\SiteDetailMapper;

class PageController extends BaseController
{
    public function getAllPages(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Pages Action:getAllPages Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $pageDigestsMapper = new PageDigestMapper($this->db);
        $pageDigests = $pageDigestsMapper->readAll(0);     
        return $this->view->render($response, 'admin\page.list.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'pageDigests' => $pageDigests));
    }

    public function getPageForCreate(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Pages Action:getPageForCreate Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = array('id' => 0, 'showIntroductionLabel' => 1, 'introductionLabel' => 'Introduction', 'showStepLabel' => 1, 'stepLabel' => 'Step', 'showStepNumber' => 1, 'showConclusionLabel' => 1, 'conclusionLabel' => 'Conclusion');
        $page = new Page($data);
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll();   
        return $this->view->render($response, 'admin\page.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'categories' => $categories, 'page' => $page));
    }

    public function getPageById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Pages Action:getPageById Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $pageMapper = new PageMapper($this->db);
        $page = $pageMapper->read($args['id']);
        $pageDigestMapper = new PageDigestMapper($this->db);
        $pageDigest = $pageDigestMapper->readBySlug($page->getSlug(), 0);
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll();      
        return $this->view->render($response, 'admin\page.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'categories' => $categories, 'page' => $page, 'pageDigest' => $pageDigest));
    }

    public function getPageByIdForDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Pages Action:getPageByIdForDelete Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $pageMapper = new PageMapper($this->db);
        $pageMapper->delete($args['id']);     
        $pageDigestsMapper = new PageDigestMapper($this->db);
        $pageDigests = $pageDigestsMapper->readAll(0);     
        return $this->view->render($response, 'admin\page.list.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'pageDigests' => $pageDigests));
    }

    public function postPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Pages Action:postPage Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = $request->getParsedBody();
        $data['slug'] = str_replace(' ', '-', strtolower($data['title']));
        $data['slug'] = str_replace('.', '-', $data['slug']);
        if (array_key_exists ('showIntroductionLabel', $data)) {
            $data['showIntroductionLabel'] = $data['showIntroductionLabel'] == "on" ? 1 : 0;
        }
        else {
            $data['showIntroductionLabel'] = 0;
        }
        if (array_key_exists ('showBodyLabel', $data)) {
            $data['showBodyLabel'] = $data['showBodyLabel'] == "on" ? 1 : 0;
        }
        else {
            $data['showBodyLabel'] = 0;
        }
        if (array_key_exists ('showStepLabel', $data)) {
            $data['showStepLabel'] = $data['showStepLabel'] == "on" ? 1 : 0;
        }
        else {
            $data['showStepLabel'] = 0;
        }
        if (array_key_exists ('showStepNumber', $data)) {
            $data['showStepNumber'] = $data['showStepNumber'] == "on" ? 1 : 0;
        }
        else {
            $data['showStepNumber'] = 0;
        }
        if (array_key_exists ('showConclusionLabel', $data)) {
            $data['showConclusionLabel'] = $data['showConclusionLabel'] == "on" ? 1 : 0;
        }
        else {
            $data['showConclusionLabel'] = 0;
        }
        if (array_key_exists ('published', $data)) {
            $data['published'] = $data['published'] == "on" ? 1 : 0;
        }
        else {
            $data['published'] = 0;
        }
        if ($data['authorId'] == 0) {
            $data['authorId'] = $_SESSION["accountId"];
        }
        $data['updaterId'] = $_SESSION["accountId"];
        if ($data['dateCreated'] == "") {
            $data['dateCreated'] = date('Y-m-d H:i:s');
        }
        $data['dateModified'] = date('Y-m-d H:i:s');
        $page = new Page($data);
        $pageMapper = new PageMapper($this->db);
        if ($page->getId() > 0){
            $pageMapper->update($page);
        }
        else {
            $id = $pageMapper->create($page);
            $page->setId($id);
        }
        $pageDigestMapper = new PageDigestMapper($this->db);
        $pageDigest = $pageDigestMapper->readBySlug($page->getSlug(), 0);
        $categoriesMapper = new CategoryMapper($this->db);
        $categories = $categoriesMapper->readAll(); 
        return $this->view->render($response, 'admin\page.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'categories' => $categories, 'page' => $page, 'pageDigest' => $pageDigest));
    }
}
