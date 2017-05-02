<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Model\AdminSession;
use App\Model\NavSession;
use App\ModelMapper\SiteDetailMapper;
use App\ModelMapper\ThemeMapper;

abstract class BaseController
{
    protected $logger;
    protected $view;
    protected $db;

    public function __construct(LoggerInterface $logger, Twig $view, \PDO $db)
    {
        $this->logger   = $logger;
        $this->view   = $view;
        $this->db   = $db;
    }

    protected function getSiteDetail()
    {
        $siteDetailMapper = new SiteDetailMapper($this->db);
        $siteDetail = $siteDetailMapper->read();
        return $siteDetail;
    }

    protected function getTheme()
    {
        $themeMapper = new ThemeMapper($this->db);
        $theme = $themeMapper->read();     
        return $theme;
    }

    protected function getNavSession($pageTitle, $section, $subSection)
    {
        $data = array('pageTitle' => $pageTitle, 'section' => $section, 'subSection' => $subSection);
        $navSession = new NavSession($data);
        return $navSession;
    }  

    protected function getAdminSession()
    {
        if (isset($_SESSION["accountId"])) {
            $data = array('accountId' => $_SESSION["accountId"], 'isAdmin' => $_SESSION["isAdmin"] ?? 0);
            $adminSession = new AdminSession($data);
            return $adminSession;
        }
        else {
            return null;
        }
    }
}
