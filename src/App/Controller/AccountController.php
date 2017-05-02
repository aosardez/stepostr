<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controller\BaseController;
use App\Model\Account;
use App\ModelMapper\AccountMapper;
use App\ModelMapper\SiteDetailMapper;

class AccountController extends BaseController
{
    public function getLogin(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Account Action:getLogin Client:" . $_SERVER['REMOTE_ADDR']);           
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        return $this->view->render($response, 'admin\login.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Login', null, null), 'adminSession' => $adminSession));
    }

    public function getLogout(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Account Action:getLogout Client:" . $_SERVER['REMOTE_ADDR']);           
        session_unset();
        $siteDetail = $this->getSiteDetail();
        return $this->view->render($response, 'admin\login.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Login', null, null)));
    }

    public function postLogin(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Account Action:postAccount Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $accessDenied = true;
        $accountMapper = new AccountMapper($this->db);
        $data = $request->getParsedBody(); 
        $account = $accountMapper->readByUsername($data['username']);
        if ($account != null && $account->getPassword() == $data['password']) {
            $accessDenied = false;
            $_SESSION["accountId"] = $account->getId();
            $_SESSION["isAdmin"] = $account->getAdmin();
            $adminSession = $this->getAdminSession();
            $account->setLastLoginDate(date('Y-m-d H:i:s'));
            $accountMapper->update($account);
            return $this->view->render($response, 'admin\account.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('My Account', 'Account', null), 'adminSession' => $adminSession, 'account' => $account));  
        }
        else {            
            return $this->view->render($response, 'admin\login.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Login', null, null), 'accessDenied' => $accessDenied));
        }
    }

    public function getAccount(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Account Action:getAccount Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $accountMapper = new AccountMapper($this->db);
        $account = $accountMapper->read($_SESSION["accountId"]);
        return $this->view->render($response, 'admin\account.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('My Account', 'Account', null), 'adminSession' => $adminSession, 'account' => $account));
    }    

    public function postAccount(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Account Action:postAccount Client:" . $_SERVER['REMOTE_ADDR']);
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null) {
            return $this->view->render($response, 'admin\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
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
        $data['dateModified'] = date('Y-m-d H:i:s');
        $account = new Account($data);
        $accountMapper = new AccountMapper($this->db);
        $accountMapper->update($account);
        return $this->view->render($response, 'admin\account.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('My Account', 'Account', null), 'adminSession' => $adminSession, 'account' => $account));
    }
}
