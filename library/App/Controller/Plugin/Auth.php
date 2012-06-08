<?php

class App_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        if ($request->getControllerName() == 'user' && $request->getControllerName() == 'error')
            return;

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
            $container = new Zend_Navigation($config);
            

            $layout = Zend_Layout::getMvcInstance();
            $view = $layout->getView();

            $session = new Zend_Session_Namespace('zend');
            $acl = $session->acl;
            
            $view->navigation($container)->setAcl($acl)->setRole(Zend_Auth::getInstance()->getIdentity());
        } else {
            $request->setControllerName('user')
                    ->setActionName('login');
        }
    }

}

?>
