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

$container['PageStepController'] = function($container){
    return new \App\Controller\PageStepController(
        $container->get('logger'),
        $container->get('view'),
        $container->get('db')
    );
};

$container['notFoundHandler'] = function ($container) {
    return new App\Handler\NotFoundHandler(
        $container->get('logger'),
        $container->get('view'), 
        $container->get('db'),
        function ($request, $response) use ($container) 
        {
            return $container['response']->withStatus(404);
        }
    );
};

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        // retrieve logger from $container here and log the error
        return $container['view']->render($response, 'error\500.html.twig', array('message' => $exception->getMessage())); 

        //$response->getBody()->rewind();
        //return $response->withStatus(500)
        //                ->withHeader('Content-Type', 'text/html')
        //                ->write("Oops, something's gone wrong!");
    };
};
 
$container['phpErrorHandler'] = function ($container) {
     return $container['errorHandler'];
    //return function ($request, $response, $error) use ($container) {


        // retrieve logger from $container here and log the error
      //  $response->getBody()->rewind();
      //  return $response->withStatus(500)
      //                  ->withHeader('Content-Type', 'text/html')
       //                 ->write("Oops, something's gone wrong!");
    //};
};