<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initLogging() {

        $logger = new Zend_Log();
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH
                        . '/../data/logs/app.log');
        $logger->addWriter($writer);
        if ('production' == $this->getEnvironment()) {
            $filter = new Zend_Log_Filter_Priority(Zend_Log::CRIT);
        } else {
            $filter = new Zend_Log_Filter_Priority(Zend_Log::DEBUG);
        }

        $logger->addFilter($filter);

        Zend_Registry::set('log', $logger);
    }
    
    protected function _initViewHelpers()
	{
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		$view->doctype('XHTML1_STRICT');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
	}	
	
	/**
	 * used for handling top-level navigation
	 * @return Zend_Navigation
	 */
	protected function _initNavigation()
	{
  		$this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();		
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

		$container = new Zend_Navigation($config);
		
		$view->navigation($container);
		

	}	
}

