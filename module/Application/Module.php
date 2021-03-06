<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        #$sm = $e->getApplication()->getServiceManager();
        // Add ACL information to the Navigation view helper
        #$authorize = $sm->get('BjyAuthorize\Service\Authorize');
        #$acl = $authorize->getAcl();
        #\Zend\View\Helper\Navigation::setDefaultAcl($acl);
        #\Zend\View\Helper\Navigation::setDefaultRole('guest');
        
        $eventManager->attach('render', function($e) {
            $sm = $e->getApplication()->getServiceManager();

            $config = $sm->get('Config');
            
            $view = $e->getViewModel();
            $view->setVariable('ers_config', $config['ERS']);
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
