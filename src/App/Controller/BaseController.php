<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\ModelMapper\SiteDetailMapper;

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
}
