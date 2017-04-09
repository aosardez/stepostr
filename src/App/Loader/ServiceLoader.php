<?php
namespace App\Loader;

use App\Application as Application;
use Symfony\Component\Finder\Finder;

class ServiceLoader
{
    private $finder;

    public function __construct(Finder $finder){
        $this->finder = $finder;
    }
    
    public function loadServices(Application $app, $directories)
    {
        $this->finder->files()->name('*.php')->depth(0)->in($directories);
        foreach ($this->finder as $file) {
            require $file->getRealpath();
        }
        return $app;
    }
}