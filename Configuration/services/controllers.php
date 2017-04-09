<?php

$container = $app->getContainer();

$container['SiteNavigationController'] = function($container){
    return new \App\Controller\SiteNavigationController(
        $container->get('logger'),
        $container->get('view'),
        $container->get('db')
    );
};

$container['AccountController'] = function($container){
    return new \App\Controller\AccountController(
        $container->get('logger'),
        $container->get('view'),
        $container->get('db')
    );
};

$container['SiteConfigurationController'] = function($container){
    return new \App\Controller\SiteConfigurationController(
        $container->get('logger'),
        $container->get('view'),
        $container->get('db')
    );
};

$container['ContributorController'] = function($container){
    return new \App\Controller\ContributorController(
        $container->get('logger'),
        $container->get('view'),
        $container->get('db')
    );
};

$container['CategoryController'] = function($container){
    return new \App\Controller\CategoryController(
        $container->get('logger'),
        $container->get('view'),
        $container->get('db')
    );
};

$container['PageController'] = function($container){
    return new \App\Controller\PageController(
        $container->get('logger'),
        $container->get('view'),
        $container->get('db')
    );
};