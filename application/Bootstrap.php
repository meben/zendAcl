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
}

