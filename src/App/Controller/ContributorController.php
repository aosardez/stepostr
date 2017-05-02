<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controller\BaseController;
use App\Model\Account;
use App\ModelMapper\AccountMapper;
use App\ModelMapper\SiteDetailMapper;

class ContributorController extends BaseController
{
    public function getAllContributors(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getAllContributors Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $contributorsMapper = new AccountMapper($this->db);
        $contributors = $contributorsMapper->readAll();     
        return $this->view->render($response, 'admin\contributor.list.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Contributors', 'Contributors', null), 'adminSession' => $adminSession, 'contributors' => $contributors));
    }

    public function getContributorForCreate(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getContributorForCreate Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = array('id' => 0);
        $contributor = new Account($data);
        return $this->view->render($response, 'admin\contributor.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Add Contributor', 'Contributors', null), 'adminSession' => $adminSession, 'contributor' => $contributor));
    }

    public function getContributorById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getContributorById Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $contributorMapper = new AccountMapper($this->db);
        $contributor = $contributorMapper->read($args['id']);     
        return $this->view->render($response, 'admin\contributor.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Edit Contributor', 'Contributors', null), 'adminSession' => $adminSession, 'contributor' => $contributor));
    }

    public function getContributorByIdForDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getContributorByIdForDelete Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $contributorsMapper = new AccountMapper($this->db);
        $contributorsMapper->delete($args['id']);     
        $contributors = $contributorsMapper->readAll();     
        return $this->view->render($response, 'admin\contributor.list.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Contributors', 'Contributors', null), 'adminSession' => $adminSession, 'contributors' => $contributors));
    }

    public function postContributor(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:postContributor Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = $request->getParsedBody(); 
        if (array_key_exists ('active', $data)) {
            $data['active'] = $data['active'] == "on" ? 1 : 0;
        }
        else {
            $data['active'] = 0;
        }
        if ($data['lastLoginDate'] == "") {
            $data['lastLoginDate'] = null;
        }
        if ($data['dateCreated'] == "") {
            $data['dateCreated'] = date('Y-m-d H:i:s');
        }
        $data['dateModified'] = date('Y-m-d H:i:s');
        $contributor = new Account($data);
        $contributorMapper = new AccountMapper($this->db);
        if ($contributor->getId() > 0){
            $contributorMapper->update($contributor);
        }
        else {
            $id = $contributorMapper->create($contributor);
            $contributor->setId($id);
        }
        return $this->view->render($response, 'admin\contributor.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('Edit Contributor', 'Contributors', null), 'adminSession' => $adminSession, 'contributor' => $contributor));        
    }
}
