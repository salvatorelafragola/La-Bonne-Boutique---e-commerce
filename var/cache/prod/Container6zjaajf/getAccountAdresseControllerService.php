<?php

namespace Container6zjaajf;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAccountAdresseControllerService extends App_KernelProdContainer
{
    /*
     * Gets the public 'App\Controller\AccountAdresseController' shared autowired service.
     *
     * @return \App\Controller\AccountAdresseController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/AccountAdresseController.php';

        $container->services['App\\Controller\\AccountAdresseController'] = $instance = new \App\Controller\AccountAdresseController(($container->services['doctrine.orm.default_entity_manager'] ?? $container->load('getDoctrine_Orm_DefaultEntityManagerService')));

        $instance->setContainer(($container->privates['.service_locator.5nX7ca3'] ?? $container->load('get_ServiceLocator_5nX7ca3Service'))->withContext('App\\Controller\\AccountAdresseController', $container));

        return $instance;
    }
}
