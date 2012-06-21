<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {
        Zend_Registry::get('log')->info(__METHOD__);  
        
        $form = new Application_Form_Login();
        $this->view->form = $form;
    }
}

