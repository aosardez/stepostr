<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\AboutMapper;
use App\ModelMapper\SiteDetailMapper;
use App\ModelMapper\ThemeMapper;

class SiteConfigurationController
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

    public function getAbout(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:getAbout Client:" . $_SERVER['REMOTE_ADDR']);   
        $aboutMapper = new AboutMapper($this->db);
        $about = $aboutMapper->read();     
        return $this->view->render($response, 'admin\about.html.twig', array('siteDetail' => $this->getSiteDetail(), 'about' => $about, 'currentTitle' => 'About Site', 'isAbout' => true));
    }

    public function postAbout(RequestInterface $request, ResponseInterface $response, $args)
    {
        // to follow
    }

    public function getTheme(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:getTheme Client:" . $_SERVER['REMOTE_ADDR']);   
        $themeMapper = new ThemeMapper($this->db);
        $theme = $themeMapper->read();     
        return $this->view->render($response, 'admin\theme.html.twig', array('siteDetail' => $this->getSiteDetail(), 'theme' => $theme, 'currentTitle' => 'Site Theme', 'isTheme' => true));
    }

    public function postTheme(RequestInterface $request, ResponseInterface $response, $args)
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
