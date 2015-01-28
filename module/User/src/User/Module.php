<?php
namespace User;

class Module {
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap($e)
    {
        $zfcServiceEvents = $e->getApplication()->getServiceManager()->get('zfcuser_user_service')->getEventManager();

        $orm = $e->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager');

        $zfcServiceEvents->attach('register', function($e) use  ($orm) {
            $userRole = $orm->getRepository('User\Entity\Role')->find(2);
            $user = $e->getParam('user');
            $user->getRoles()->add($userRole);
        });
    }

}