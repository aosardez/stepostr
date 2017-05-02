<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Controller\BaseController;
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
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $pageDigestsMapper = new PageDigestMapper($this->db);
        $pageDigests = $pageDigestsMapper->readAll(0);     
        return $this->view->render($response, 'admin\page.list.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Pages', 'Pages', null), 'adminSession' => $adminSession, 'pageDigests' => $pageDigests));
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
