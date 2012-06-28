<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initLogging() {
        $this->bootstrap('log');
        $logger = $this->getPluginResource('log')->getLog();
        Zend_Registry::set('log', $logger);
    }

    protected function _initViewHelpers() {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->doctype('XHTML1_STRICT');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
    }
    
    protected function _initDefaultModelAutoloader()
    {
        $this->_logger->info('Bootstrap ' . __METHOD__);
        
        $this->_resourceLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Application',
            'basePath'  => APPLICATION_PATH 
        ));
        
        $this->_resourceLoader->addResourceTypes(array(
            'mappers_db' => array(
              'path'      => 'models/mappers/db',
              'namespace' => 'Model_Mapper_Db',
            )  
        ));
        $this->_resourceLoader->addResourceTypes(array(
            'sources' => array(
              'path'      => 'models/sources',
              'namespace' => 'Model_Source',
            )  
        ));
        $this->_resourceLoader->addResourceTypes(array(
            'sources_db' => array(
              'path'      => 'models/sources/db',
              'namespace' => 'Model_Source_Db',
            )  
        ));
    }
}

