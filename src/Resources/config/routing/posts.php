<?php

use Zantolov\AppBundle\Service\CrudRouteBuilderService;
use Zantolov\BlogBundle\Controller\PostController;

$builder = new CrudRouteBuilderService(
    PostController::getRoutesConfig(),
    'ZantolovBlogBundle:Post'
);

return $builder->buildCrudRouteCollection();