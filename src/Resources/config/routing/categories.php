<?php

use Zantolov\AppBundle\Service\CrudRouteBuilderService;
use Zantolov\BlogBundle\Controller\CategoryController;

$builder = new CrudRouteBuilderService(
    CategoryController::getRoutesConfig(),
    'ZantolovBlogBundle:Category'
);

return $builder->buildCrudRouteCollection();