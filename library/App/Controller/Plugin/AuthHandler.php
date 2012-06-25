<?php

class App_Controller_Plugin_AuthHandler extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        Zend_Registry::get('log')->info(__METHOD__);
        
        Zend_Registry::get('log')->info($request->getModuleName());
        if ($request->getModuleName() != 'admin' ||
                $request->getControllerName() == 'error') {
            
            return;
        }
        
        if (Zend_Auth::getInstance()->hasIdentity()) {
            Zend_Registry::get('log')->info('here');
            $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/'.$request->getModuleName().'_navigation.xml', 'nav');
            $container = new Zend_Navigation($config);
            

            $layout = Zend_Layout::getMvcInstance();
            $view = $layout->getView();

            $session = new Zend_Session_Namespace('zend');
            $acl = $session->acl;
            
            $view->navigation($container)->setAcl($acl)->setRole(Zend_Auth::getInstance()->getIdentity());
        } else {
            $request->setModuleName('default')
                    ->setControllerName('user')
                    ->setActionName('login');
        }
    }

}

?>
