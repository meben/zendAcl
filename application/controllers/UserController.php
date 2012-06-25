<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function loginAction()
    {
        Zend_Registry::get('log')->info(__METHOD__);
        $this->_helper->layout()->disableLayout();
        
        $form = new Application_Form_Login();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $userservice = App_Service_Manager::getService('user');
                if($user = $userservice->isValid($form->getValues())) {
                    // We're authenticated! Redirect to the home page
                    Zend_Auth::getInstance()->getStorage()->write($user);
                    
                    $acl = $userservice->getACl();
                    $session = new Zend_Session_Namespace('zend');
                    $session->acl = $acl;
                    
                    $this->_helper->redirector('index', 'index','admin');
                }
            }
        }
        $this->view->form = $form;
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('login'); // back to login page
    }
}

