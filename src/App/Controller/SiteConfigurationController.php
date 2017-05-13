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
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $aboutMapper = new AboutMapper($this->db);
        $about = $aboutMapper->read();     
        return $this->view->render($response, 'admin\about.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('About Site', 'SiteConfiguration', 'About'), 'adminSession' => $adminSession, 'about' => $about));
    }

    public function postAbout(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:postAbout Client:" . $_SERVER['REMOTE_ADDR']);   
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = $request->getParsedBody(); 
        $data['dateModified'] = date('Y-m-d H:i:s');
        $siteDetail = new siteDetail($data);
        $siteDetailMapper = new SiteDetailMapper($this->db);
        $siteDetailMapper->update($siteDetail);
        $about = new About($data);
        $aboutMapper = new AboutMapper($this->db);
        $aboutMapper->update($about); 
        return $this->view->render($response, 'admin\about.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('About site', 'SiteConfiguration', 'About'), 'adminSession' => $adminSession, 'about' => $about));
    }

    public function getThemeInfo(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:getTheme Client:" . $_SERVER['REMOTE_ADDR']);   
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        return $this->view->render($response, 'admin\theme.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Site Theme', 'SiteConfiguration', 'Theme'), 'adminSession' => $adminSession));
    }

    public function postTheme(RequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("Area:Configuration Action:postTheme Client:" . $_SERVER['REMOTE_ADDR']);   
        $siteDetail = $this->getSiteDetail();
        $adminSession = $this->getAdminSession();
        if ($adminSession == null || !$adminSession->getIsAdmin()) {
            return $this->view->render($response, 'error\accessdenied.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Access denied!', null, null), 'adminSession' => $adminSession));
        }
        $data = $request->getParsedBody(); 
        $themeMapper = new ThemeMapper($this->db);
        $theme = $themeMapper->read();
        $theme->setName($data['name']);
        if (array_key_exists ('showSiteName', $data)) {
            $theme->setShowSiteName($data['showSiteName'] == "on" ? 1 : 0);
        }
        else {
            $theme->setShowSiteName(0);
        }
        if (array_key_exists ('showBannerImage', $data)) {
            $theme->setShowBannerImage($data['showBannerImage'] == "on" ? 1 : 0);
        }
        else {
            $theme->setShowBannerImage(0);
        }
        if (isset($_FILES["bannerImage"]) && $_FILES["bannerImage"]["name"] != null) {
            $target_dir = "/uploads/images/" . date('Y-m-d') . "/";
            $target_file = $target_dir . basename($_FILES["bannerImage"]["name"]);
            $this->uploadFile("bannerImage", $target_dir, $target_file);
            $theme->setBannerImagePath($target_file);
        }
        if (array_key_exists ('showBackgroundImage', $data)) {
            $theme->setShowBackgroundImage($data['showBackgroundImage'] == "on" ? 1 : 0);
        }
        else {
            $theme->setShowBackgroundImage(0);
        }
        if (isset($_FILES["backgroundImage"]) && $_FILES["backgroundImage"]["name"] != null) {
            $target_dir = "/uploads/images/" . date('Y-m-d') . "/";
            $target_file = $target_dir . basename($_FILES["backgroundImage"]["name"]);
            $this->uploadFile("backgroundImage", $target_dir, $target_file);
            $theme->setBackgroundImagePath($target_file);
        }
        $theme->setDateModified(date('Y-m-d H:i:s'));
        $themeMapper->update($theme);
        return $this->view->render($response, 'admin\theme.html.twig', array('siteDetail' => $siteDetail, 'theme' => $this->getTheme(), 'navSession' => $this->getNavSession('Site Theme', 'SiteConfiguration', 'Theme'), 'adminSession' => $adminSession, 'theme' => $theme));
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
