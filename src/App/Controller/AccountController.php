<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\AccountMapper;
use App\ModelMapper\SiteDetailMapper;

class AccountController
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

    public function getLogin(RequestInterface $request, ResponseInterface $response, $args)
    {
        $_SESSION["accountId"] = 1;

        $this->logger->debug("Area:Account Action:getLogin Client:" . $_SERVER['REMOTE_ADDR']);   
        return $this->view->render($response, 'admin\login.html.twig', array('message' => 'Please enter username and password.'));
    }

    public function postLogin(RequestInterface $request, ResponseInterface $response, $args)
    {
        // to follow
    }

    public function getAccount(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Account Action:getAccount Client:" . $_SERVER['REMOTE_ADDR']);
        $accountMapper = new AccountMapper($this->db);
        $account = $accountMapper->read($_SESSION["accountId"]);
        return $this->view->render($response, 'admin\account.html.twig', array('siteDetail' => $this->getSiteDetail(), 'account' => $account, 'currentTitle' => 'My Account', 'isAccount' => true));
    }    

    public function postAccount(RequestInterface $request, ResponseInterface $response, $args)
    {
        // to follow
    }

    private function getSiteDetail()
    {
        $siteDetailMapper = new SiteDetailMapper($this->db);
        $siteDetail = $siteDetailMapper->read();
        return $siteDetail;
    }
}
