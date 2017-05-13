<?php
namespace App\Handler;

use Psr\Log\LoggerInterface;
use Slim\Handlers\NotFound;
use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\ModelMapper\SiteDetailMapper;
use App\ModelMapper\ThemeMapper;

class NotFoundHandler extends NotFound {

    protected $logger;
    protected $view;
    protected $db;

    public function __construct(LoggerInterface $logger, Twig $view, \PDO $db) {
        $this->logger   = $logger;
        $this->view   = $view;
        $this->db   = $db;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {
        $this->logger->debug("Area:NotFoundHandler Action:Invoke Client:" . $_SERVER['REMOTE_ADDR']);      
        parent::__invoke($request, $response);

        $this->view->render($response, 'error\404.html.twig', array('siteDetail' => $this->getSiteDetail(), 'theme' => $this->getTheme()));

        return $response->withStatus(404);
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
}