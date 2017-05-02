<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Controller\BaseController;
use App\Model\About;
use App\Model\SiteDetail;
use App\ModelMapper\AboutMapper;
use App\ModelMapper\SiteDetailMapper;
use App\ModelMapper\ThemeMapper;

class SiteConfigurationController extends BaseController
{
    public function getAbout(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:getAbout Client:" . $_SERVER['REMOTE_ADDR']);   
        $aboutMapper = new AboutMapper($this->db);
        $about = $aboutMapper->read();     
        return $this->view->render($response, 'admin\about.html.twig', array('siteDetail' => $this->getSiteDetail(), 'navSession' => $this->getNavSession('About Site', 'SiteConfiguration', 'About'), 'about' => $about));
    }

    public function postAbout(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:postAbout Client:" . $_SERVER['REMOTE_ADDR']);   
        $data = $request->getParsedBody(); 
        $data['dateModified'] = date('Y-m-d H:i:s');
        $siteDetail = new siteDetail($data);
        $siteDetailMapper = new SiteDetailMapper($this->db);
        $siteDetailMapper->update($siteDetail);
        $about = new About($data);
        $aboutMapper = new AboutMapper($this->db);
        $aboutMapper->update($about); 
        return $this->view->render($response, 'admin\about.html.twig', array('siteDetail' => $siteDetail, 'navSession' => $this->getNavSession('About site', 'SiteConfiguration', 'About'), 'about' => $about, 'currentTitle' => 'About Site', 'isAbout' => true));
    }

    public function getTheme(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:getTheme Client:" . $_SERVER['REMOTE_ADDR']);   
        $themeMapper = new ThemeMapper($this->db);
        $theme = $themeMapper->read();     
        return $this->view->render($response, 'admin\theme.html.twig', array('siteDetail' => $this->getSiteDetail(), 'navSession' => $this->getNavSession('Site Theme', 'SiteConfiguration', 'Theme')));
    }

    public function postTheme(RequestInterface $request, ResponseInterface $response, $args)
    {
        // to follow
    }
}
