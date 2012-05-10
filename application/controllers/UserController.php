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
                if ($this->_process($form->getValues())) {
                    // We're authenticated! Redirect to the home page
                    $this->_helper->redirector('index', 'index');
                }
            }
        }
        $this->view->form = $form;
    }
    
    protected function _process($values)
    {
        Zend_Registry::get('log')->info(__METHOD__);
            
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username']); 
        $adapter->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $this->_getUser($adapter);
            $user->acl = $this->_loadAcl();
            Zend_Registry::get('log')->debug(var_export($user,true));            
            $auth->getStorage()->write($user);            
            return true;
        }
        return false;
    }
    
    protected function _getAuthAdapter() {
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('user')
            ->setIdentityColumn('name')
            ->setCredentialColumn('password')
            ->setCredentialTreatment('SHA1(CONCAT(?,salt))');
            
        
        return $authAdapter;
    }
    
    protected function _getUser($adapter) {
        $user = $adapter->getResultRowObject();        
        $user->role = 'admin';
        return $user;
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('login'); // back to login page
    }
    
    protected function _loadAcl() {
        $acl = new Zend_Acl();
 
        $acl->addRole(new Zend_Acl_Role('admin'));
        
        $acl->add(new Zend_Acl_Resource('As'));
        $acl->add(new Zend_Acl_Resource('Bs'));
        $acl->add(new Zend_Acl_Resource('A'));
                
        $acl->allow('admin', 'As');
        $acl->allow('admin', 'Bs');
        $acl->allow('admin', 'A','delete');
        
        return $acl;
    }
}

