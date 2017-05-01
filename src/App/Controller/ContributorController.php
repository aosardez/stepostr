<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Model\Account;
use App\ModelMapper\AccountMapper;
use App\ModelMapper\SiteDetailMapper;

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
        $contributorsMapper = new AccountMapper($this->db);
        $contributors = $contributorsMapper->readAll();     
        return $this->view->render($response, 'admin\contributor.list.html.twig', array('siteDetail' => $this->getSiteDetail(), 'contributors' => $contributors, 'currentTitle' => 'Contributors', 'isContributors' => true));
    }

    public function getContributorForCreate(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getContributorForCreate Client:" . $_SERVER['REMOTE_ADDR']);
        $data = array('id' => 0);
        $contributor = new Account($data);
        return $this->view->render($response, 'admin\contributor.html.twig', array('siteDetail' => $this->getSiteDetail(), 'contributor' => $contributor, 'currentTitle' => 'Add Contributor', 'isContributors' => true));
    }

    public function getContributorById(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getContributorById Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $contributorMapper = new AccountMapper($this->db);
        $contributor = $contributorMapper->read($args['id']);     
        return $this->view->render($response, 'admin\contributor.html.twig', array('siteDetail' => $this->getSiteDetail(), 'contributor' => $contributor, 'currentTitle' => 'Edit Contributor', 'isContributors' => true));
    }

    public function getContributorByIdForDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:getContributorByIdForDelete Client:" . $_SERVER['REMOTE_ADDR'] . " Arguments:" . $args['id']);
        $contributorsMapper = new AccountMapper($this->db);
        $contributorsMapper->delete($args['id']);     
        $contributors = $contributorsMapper->readAll();     
        return $this->view->render($response, 'admin\contributor.list.html.twig', array('siteDetail' => $this->getSiteDetail(), 'contributors' => $contributors, 'currentTitle' => 'Contributors', 'isContributors' => true));
    }

    public function postContributor(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Contributors Action:postContributor Client:" . $_SERVER['REMOTE_ADDR']);
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
        return $this->view->render($response, 'admin\contributor.html.twig', array('siteDetail' => $this->getSiteDetail(), 'contributor' => $contributor, 'currentTitle' => 'Edit Contributor', 'isContributors' => true));        
    }

    private function getSiteDetail()
    {
        $siteDetailMapper = new SiteDetailMapper($this->db);
        $siteDetail = $siteDetailMapper->read();
        return $siteDetail;
    }
}
